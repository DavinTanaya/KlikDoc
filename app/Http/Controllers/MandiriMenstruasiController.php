<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MandiriMenstruasiController extends Controller
{
    public function index(){
        return view('user.mandiri.kalender-menstruasi.index');
    }
}
