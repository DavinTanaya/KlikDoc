<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\UserCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cartItems = UserCart::where('user_id', auth()->user()->id)
            ->with(relations: 'drug')
            ->get();
        $cartBadge = $cartItems->count();
        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->quantity * $item->drug->price);
        }, 0);
        return view('user.layanan.apotek.payment.cart', ['cartItems' => $cartItems, 'cartBadge' => $cartBadge, 'total' => $total]);
    }

    public function addCart(Request $request, $id) {
        $drug = Drug::findOrFail($id);
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $drug->stock,
        ]);
        if(UserCart::where('user_id', auth()->user()->id)->where('drug_id', $drug->id)->exists()) {
            $existingCart = UserCart::where('user_id', auth()->user()->id)->where('drug_id', $drug->id)->first();
            $newQuantity = $existingCart->quantity + $request->input('quantity');
            if($newQuantity > $drug->stock) {
                return redirect()->back()->with('error', 'Jumlah obat di keranjang melebihi stok yang tersedia!');
            }
            $existingCart->update(['quantity' => $newQuantity]);
            return redirect()->back()->with('success', 'Obat berhasil ditambahkan ke keranjang!');
        }
        UserCart::create([
            'user_id' => auth()->user()->id,
            'drug_id' => $drug->id,
            'quantity' => $request->input('quantity'),
        ]);
        return redirect()->back()->with('success', 'Obat berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request, $id) {
        $cartItem = UserCart::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();
        $drug = Drug::findOrFail($cartItem->drug_id);
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $drug->stock,
        ]);
        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);
        return redirect()->back()->with('success', 'Jumlah obat di keranjang berhasil diperbarui!');
    }

    public function removeCart($id) {
        $cartItem = UserCart::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();
        $cartItem->delete();
        return redirect()->back()->with('success', 'Obat berhasil dihapus dari keranjang!');
    }

    public function removeSelectedCart(Request $request) {
        $ids = json_decode($request->ids);
        UserCart::where('user_id', auth()->user()->id)
            ->whereIn('id', $ids)
            ->delete();

        return redirect()->back()->with('success', 'Obat terpilih berhasil dihapus dari keranjang!');
    }
}
