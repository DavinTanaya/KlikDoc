<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Order;
use App\Models\Province;
use App\Models\UserCart;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $ids = $request->query('ids')
            ? json_decode($request->query('ids'), true)
            : session('checkout_ids');

        if (!$ids || !is_array($ids)) {
            return redirect()->route('apotek_keranjang')
                ->with('error', 'Tidak ada item untuk checkout.');
        }

        session(['checkout_ids' => $ids]);

        $cartItems = UserCart::with('drug')
            ->whereIn('id', $ids)
            ->where('user_id', auth()->id())
            ->get();

        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->drug->price);

        $shipping = 15000;
        $shipping_discount = 5000;
        $service_fee = 1000;

        $voucher = session('voucher');

        $discount = $voucher['discount'] ?? 0;

        $total = $subtotal - $discount + $shipping - $shipping_discount + $service_fee;

        $addresses = Address::with(['cityRelation', 'provinceRelation'])
            ->where('user_id', auth()->id())
            ->get();

        return view('user.layanan.apotek.payment.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'shipping_discount' => $shipping_discount,
            'service_fee' => $service_fee,
            'discount' => $discount,
            'total' => $total,
            'voucher' => $voucher,
            'defaultAddress' => $addresses->where('is_default', 1)->first() ?? $addresses->first(),
            'noAddress' => $addresses->count() === 0,
            'addresses' => $addresses,
            'provinces' => Province::all(),
            'cities' => City::all(),
        ]);
    }


    public function useVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string'
        ]);

        $voucher = Voucher::where('code', strtoupper($request->voucher_code))->first();

        if (!$voucher || !$voucher->isValid()) {
            return back()->with('error', 'Voucher tidak valid atau sudah kadaluarsa.');
        }

        $ids = session('checkout_ids');
        $cartItems = UserCart::with('drug')
            ->whereIn('id', $ids)
            ->where('user_id', auth()->id())
            ->get();

        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->drug->price);

        if($voucher->min_order_amount && $subtotal < $voucher->min_order_amount) {
            return back()->with('error', 'Subtotal tidak memenuhi syarat minimum untuk voucher ini.');
        }

        $discount = 0;

        if ($voucher->discount_percentage) {
            $discount = ($subtotal * $voucher->discount_percentage) / 100;
        }

        if ($voucher->discount_amount) {
            $discount = $voucher->discount_amount;
        }

        $discount = min($discount, $subtotal);

        session([
            'voucher' => [
                'code' => $voucher->code,
                'discount' => $discount,
            ]
        ]);

        return back()->with('success', 'Voucher berhasil diterapkan.');
    }

    public function pay(Request $request)
    {
        $user = auth()->user();
        $ids = session('checkout_ids');

        if (!$ids) {
            return back()->with('error', 'Tidak ada item untuk dibayar.');
        }
        
        $address = Address::where('user_id', $user->id)
            ->where('is_default', 1)
            ->first();

        if (!$address) {
            return back()->with('error', 'Alamat pengiriman belum ditentukan.');
        }

        $cartItems = UserCart::with('drug')
            ->whereIn('id', $ids)
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->count() === 0) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $subtotal = $cartItems->sum(fn ($item) => $item->drug->price * $item->quantity);
        $shipping_fee = 15000;
        $shipping_discount = 5000;
        $service_fee = 1000;

        $voucher = session('voucher');
        $voucher_discount = $voucher['discount'] ?? 0;

        $total = $subtotal + $shipping_fee + $service_fee - $voucher_discount;

        $orderCode = "KD-" . strtoupper(uniqid());



        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $address->id,
            'order_code' => $orderCode,
            'subtotal' => $subtotal,
            'shipping_fee' => $shipping_fee,
            'service_fee' => $service_fee,
            'voucher_discount' => $voucher_discount,
            'total' => $total,
            'status' => 'BELUM_BAYAR',
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'drug_id' => $item->drug_id,
                'quantity' => $item->quantity,
                'price' => $item->drug->price,
                'total' => $item->drug->price * $item->quantity,
            ]);
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $itemDetails = $order->items->map(function ($item) {
            return [
                'id' => $item->drug_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->drug->name,
            ];
        })->toArray();

        $itemDetails[] = [
            'id' => 'shipping_fee',
            'price' => $shipping_fee,
            'quantity' => 1,
            'name' => 'Biaya Pengiriman',
        ];
        $itemDetails[] = [
            'id' => 'shipping_discount',
            'price' => -$shipping_discount,
            'quantity' => 1,
            'name' => 'Diskon Pengiriman',
        ];

        $itemDetails[] = [
            'id' => 'service_fee',
            'price' => $service_fee,
            'quantity' => 1,
            'name' => 'Biaya Layanan',
        ];

        if ($voucher_discount > 0) {
            $itemDetails[] = [
                'id' => 'voucher_discount',
                'price' => -$voucher_discount,
                'quantity' => 1,
                'name' => 'Voucher Discount',
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? "08123456789",
            ],
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => route('apotek.checkout.success', $order->order_code),
            ]
        ];

        $snap = Snap::createTransaction($params);

        $order->update([
            'snap_token' => $snap->token,
        ]);

        return redirect($snap->redirect_url);
    }


    public function success($code)
    {
        $order = Order::with(['items.drug', 'address.cityRelation', 'address.provinceRelation'])
            ->where('order_code', $code)
            ->firstOrFail();

        $order->update([
            'status' => 'DIPROSES'
        ]);

        $drugIds = $order->items->pluck('drug_id')->toArray();

        UserCart::where('user_id', $order->user_id)
            ->whereIn('drug_id', $drugIds)
            ->delete();

        session()->forget(['voucher', 'checkout_ids']);

        return view('user.layanan.apotek.payment.success', compact('order'));
    }

    public function retry($orderCode)
    {
        $order = Order::with(['items.drug', 'address.cityRelation', 'address.provinceRelation'])
            ->where('order_code', $orderCode)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $voucher = session('voucher');
        $voucher_discount = $voucher['discount'] ?? 0;
        $shipping_fee = 15000;
        $shipping_discount = 5000;
        $service_fee = 1000;
        $itemDetails = $order->items->map(function ($item) {
            return [
                'id' => $item->drug_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->drug->name,
            ];
        })->toArray();

        $itemDetails[] = [
            'id' => 'shipping_fee',
            'price' => $shipping_fee,
            'quantity' => 1,
            'name' => 'Biaya Pengiriman',
        ];
        $itemDetails[] = [
            'id' => 'shipping_discount',
            'price' => -$shipping_discount,
            'quantity' => 1,
            'name' => 'Diskon Pengiriman',
        ];
        $itemDetails[] = [
            'id' => 'service_fee',
            'price' => $service_fee,
            'quantity' => 1,
            'name' => 'Biaya Layanan',
        ];

        if ($voucher_discount > 0) {
            $itemDetails[] = [
                'id' => 'voucher_discount',
                'price' => -$voucher_discount,
                'quantity' => 1,
                'name' => 'Voucher Discount',
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => route('apotek.checkout.success', $order->order_code),
            ]
        ];

        $snap = Snap::createTransaction($params);

        $order->update(['snap_token' => $snap->token]);

        return redirect($snap->redirect_url);
    }

}
