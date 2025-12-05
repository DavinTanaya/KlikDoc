<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiDokterSuccessController extends Controller
{
    public function index() {
        return view('user.layanan.konsultasi.payment.success');
    }
}
