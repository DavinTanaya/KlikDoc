<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengingatObatController extends Controller
{
    public function index() {
        return view('mandiri.pengingat_obat.index');
    }
}
