<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlikHomeHistoryController extends Controller
{
    public function index() {
        return view('user.layanan.klik-home.history.index');
    }

    public function detail() {
        return view('user.layanan.klik-home.history.detail');
    }
}
