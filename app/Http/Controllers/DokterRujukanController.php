<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterRujukanController extends Controller
{
    public function index(){
        return view('dokter.layanan.rujukan');
    }
}
