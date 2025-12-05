<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiDokterDetailController extends Controller
{
    public function index() {
        return view('user.layanan.konsultasi.dokter.detail');
    }
}
