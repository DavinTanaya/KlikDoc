<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiDokterController extends Controller
{
    public function index() {
        return view ('user.layanan.konsultasi.dokter.index');
    }
}
