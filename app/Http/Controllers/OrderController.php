<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function history()
    {
        $status = request()->query('status');
        if(in_array($status, ['BELUM_BAYAR', 'DIPROSES', 'SELESAI', 'DIBATALKAN'])) {
            $orders = Order::with(['items.drug', 'address.cityRelation', 'address.provinceRelation'])
                ->where('user_id', auth()->id())
                ->where('status', $status)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('user.layanan.apotek.history.index', compact('orders'));
        }
        $orders = Order::with(['items.drug', 'address.cityRelation', 'address.provinceRelation'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.layanan.apotek.history.index', compact('orders'));
    }
    public function detail($code)
    {
        $order = Order::with(['items.drug', 'address', 'address.cityRelation', 'address.provinceRelation'])
            ->where('order_code', $code)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.layanan.apotek.history.detail', compact('order'));
    }

}
