<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\KlikHomeOrder;
use App\Models\KlikHomeService;
use App\Models\Province;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class KlikHomeController extends Controller
{
    public function index(Request $request) {
        $services = KlikHomeService::query()
        ->where('is_active', true)
        ->when($request->category, fn ($q) =>
            $q->whereIn('category', $request->category)
        )
        ->when($request->search, fn ($q) =>
            $q->where('name', 'like', "%{$request->search}%")
        )
        ->orderBy('name')
        ->get();

        $recentOrders = KlikHomeOrder::with('service')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        return view('user.layanan.klik-home.service.index', compact('services', 'recentOrders'));
    }

    public function detail(KlikHomeService $service) {
        $provinces = Province::all();
        $cities = City::all();
        $defaultAddress = auth()->user()->addresses()->where('is_default', true)->first();
        return view('user.layanan.klik-home.service.detail', compact('service','provinces', 'cities', 'defaultAddress'));
    }

     public function pay(Request $request, KlikHomeService $service)
    {
        $user = auth()->user();

        $request->validate([
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required|string',
        ]);

        $address = Address::where('user_id', $user->id)
            ->where('is_default', true)
            ->first();

        if (!$address) {
            return back()->with('error', 'Alamat belum ditentukan');
        }

        $orderCode = 'KH-' . strtoupper(uniqid());

        $order = KlikHomeOrder::create([
            'order_code' => $orderCode,
            'user_id' => $user->id,
            'klikhome_service_id' => $service->id,
            'user_address_id' => $address->id,
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
            'subtotal' => $service->price,
            'service_fee' => $service->service_fee,
            'total' => $service->price + $service->service_fee,
            'status' => 'MENUNGGU_PEMBAYARAN',
        ]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => $service->id,
                    'price' => $service->price,
                    'quantity' => 1,
                    'name' => $service->name,
                ],
                [
                    'id' => 'service_fee',
                    'price' => $service->service_fee,
                    'quantity' => 1,
                    'name' => 'Biaya Layanan',
                ],
            ],
            'callbacks' => [
                'finish' => route('klikhome.success', $order->order_code),
            ],
        ];

        $snap = Snap::createTransaction($params);

        $order->update([
            'snap_token' => $snap->token,
            'midtrans_order_id' => $order->order_code,
        ]);

        return redirect($snap->redirect_url);
    }

    public function success($orderCode)
    {
        $order = KlikHomeOrder::with([
            'service',
            'user',
            'address.cityRelation',
            'address.provinceRelation'
        ])->where('order_code', $orderCode)->firstOrFail();

        $order->update([
            'status' => 'DIBAYAR',
            'payment_type' => $order->payment_type ?? 'Virtual Account',
        ]);

        return view('user.layanan.klik-home.payment.success', compact('order'));
    }


    public function retry($orderCode)
    {
        $order = KlikHomeOrder::with('service')
            ->where('order_code', $orderCode)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($order->status !== 'MENUNGGU_PEMBAYARAN') {
            return back()->with('error', 'Order tidak bisa dibayar ulang');
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
            'item_details' => [
                [
                    'id' => $order->service->id,
                    'price' => $order->service->price,
                    'quantity' => 1,
                    'name' => $order->service->name,
                ],
                [
                    'id' => 'service_fee',
                    'price' => $order->service_fee,
                    'quantity' => 1,
                    'name' => 'Biaya Layanan',
                ],
            ],
            'callbacks' => [
                'finish' => route('klikhome.success', $order->order_code),
            ],
        ];

        $snap = Snap::createTransaction($params);

        $order->update([
            'snap_token' => $snap->token,
        ]);

        return redirect($snap->redirect_url);
    }

    public function history(Request $request)
    {
        $query = KlikHomeOrder::with('service')
            ->where('user_id', auth()->id())
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        return view('user.layanan.klik-home.history.index', compact('orders'));
    }


    public function detailHistory(Request $request)
    {
        $orderCode = $request->query('orderCode');

        abort_if(!$orderCode, 404);
        $order = KlikHomeOrder::with([
            'service',
            'address.cityRelation',
            'address.provinceRelation'
        ])->where('order_code', $orderCode)
          ->where('user_id', auth()->id())
          ->firstOrFail();

        return view('user.layanan.klik-home.history.detail', compact('order'));
    }
}
