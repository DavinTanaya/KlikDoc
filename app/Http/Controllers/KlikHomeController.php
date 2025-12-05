<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlikHomeController extends Controller
{
    public function index() {
        return view('user.layanan.klik-home.service.index');
    }

    public function detail() {
        return view('user.layanan.klik-home.service.detail');
    }
}
