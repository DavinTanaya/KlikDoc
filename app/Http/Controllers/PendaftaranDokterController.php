<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranDokterController extends Controller
{
    public function index() {
        return view('dokter.pendaftaran_dokter.index');
    }
}
