<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterJadwalPraktikController extends Controller
{
    public function index() {
        return view('dokter.layanan.jadwal_praktik');
    }
}
