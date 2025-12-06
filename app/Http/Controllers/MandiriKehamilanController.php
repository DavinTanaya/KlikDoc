<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MandiriKehamilanController extends Controller
{
    public function index(){
        return view('user.mandiri.kalender-kehamilan.index');
    }
}
