<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index() {
        return view('user.layanan.artikel.index');
    }

    public function detail() {
        return view('user.layanan.artikel.detail');
    }
}
