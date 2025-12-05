<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterDashboardController extends Controller
{
    public function index() {
        return view('dokter.dashboard.index');
    }
}
