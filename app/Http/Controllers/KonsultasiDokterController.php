<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiDokterController extends Controller
{
    public function index() {
        return view ('user.layanan.konsultasi.dokter.index');
    }

    public function detail() {
        return view('user.layanan.konsultasi.dokter.detail');
    }

    public function success() {
        return view('user.layanan.konsultasi.payment.success');
    }
}
