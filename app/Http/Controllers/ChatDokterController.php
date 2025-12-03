<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatDokterController extends Controller
{
    public function index(){
        return view('layanan.chat_dokter.index');
    }
}
