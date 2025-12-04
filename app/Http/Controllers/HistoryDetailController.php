<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryDetailController extends Controller
{
    public function index() {
        return view ('user.layanan.apotek.history.detail');
    }
}
