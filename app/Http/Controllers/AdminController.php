<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getApotekHtml() {
        $drugs = Drug::where('is_active', true)->get();
        return view('admin.pages.apotek', compact('drugs'))->render();
    }
}
