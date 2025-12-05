<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiHistoryController extends Controller
{
    public function index() {
        return view('user.layanan.konsultasi.history.index');
    }

    public function detail() {
        return view('user.layanan.konsultasi.history.detail');
    }
}
