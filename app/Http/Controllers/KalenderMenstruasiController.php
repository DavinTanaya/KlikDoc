<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalenderMenstruasiController extends Controller
{
    public function index() {
        return view('user.mandiri.kalender_menstruasi.index');
    }
}
