<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MandiriObatController extends Controller
{
    public function index(){
        return view('user.mandiri.pengingat-obat.index');
    }
}
