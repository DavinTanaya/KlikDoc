<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index() {
        return view('mandiri.bmi.index');
    }
}
