<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MandiriController extends Controller
{
    public function bmi(){
        return view('user.mandiri.kalkulator-bmi.index');
    }

    public function kalenderKehamilan() {
        return view('user.mandiri.kalender-kehamilan.index');
    }

    public function kalenderMenstruasi(){
        return view('user.mandiri.kalender-menstruasi.index');
    }

    public function pengingatObat(){
        return view('user.mandiri.pengingat-obat.index');
    }
}
