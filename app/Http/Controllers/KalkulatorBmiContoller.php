<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalkulatorBmiContoller extends Controller
{
    public function index() {
        return view('user.mandiri.kalkulator_bmi.index');
    }
}
