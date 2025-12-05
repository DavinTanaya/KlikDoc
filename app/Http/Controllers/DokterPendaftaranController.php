<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterPendaftaranController extends Controller
{
    public function index() {
        return view('dokter.pendaftaran.index');
    }
}
