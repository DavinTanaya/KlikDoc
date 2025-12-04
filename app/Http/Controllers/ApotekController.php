<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index() {
        return view('user.layanan.apotek.obat.index');
    }
}
