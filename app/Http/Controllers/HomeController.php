<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        $informationPath = public_path('image/home/information');
        $informationFile = File::files($informationPath);

        $promoPath = public_path('image/home/promo');
        $promoFile = File::files($promoPath);

        return view('home.index', compact('informationFile', 'promoFile'));
    }
}
