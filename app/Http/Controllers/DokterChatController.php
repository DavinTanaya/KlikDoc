<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterChatController extends Controller
{
    public function index() {
        return view('dokter.chat.index');
    }
}
