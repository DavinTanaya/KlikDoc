<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Order;
use App\Models\UserCart;
use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index() {
        $query = Drug::where('is_active', true);

        $search = request()->query('search');
        if($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $filter = request()->query('filter');
        if($filter === 'harga-terendah') {
            $query->orderBy('price', 'asc');
        } elseif($filter === 'harga-tertinggi') {
            $query->orderBy('price', 'desc');
        }

        $kategoriJson = request()->query('kategori_json');
        $kategoriList = $kategoriJson ? json_decode($kategoriJson, true) : [];

        if (!empty($kategoriList)) {
            $query->whereIn('category', $kategoriList);
        }

        if ($min = request()->query('price_min')) {
            $query->where('price', '>=', (int) $min);
        }

        if ($max = request()->query('price_max')) {
            $query->where('price', '<=', (int) $max);
        }

        $drugs = $query->paginate(8);
        
        $cartBadge = UserCart::where('user_id', auth()->user()->id)->count();
        $totalEstimation = UserCart::where('user_id', auth()->user()->id)
            ->join('drugs', 'user_carts.drug_id', '=', 'drugs.id')
            ->selectRaw('SUM(user_carts.quantity * drugs.price) as total')
            ->value('total') ?? 0;

        $categories = Drug::select('category')->distinct()->pluck('category');
        $recentOrders = Order::with('items.drug')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
        return view('user.layanan.apotek.obat.index', ['drugs' => $drugs, 'cartBadge' => $cartBadge, 'totalEstimation' => $totalEstimation, 'categories' => $categories, 'recentOrders' => $recentOrders]);
    }
}
