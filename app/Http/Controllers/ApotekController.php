<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index() {
        $drugs = Drug::where('is_active', true)->paginate(8);
        return view('user.layanan.apotek.obat.index', ['drugs' => $drugs]);
    }
}
