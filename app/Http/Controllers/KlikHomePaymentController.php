<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlikHomePaymentController extends Controller
{
    public function payment() {
        return view('user.layanan.klik-home.payment.checkout');
    }

    public function success(){
        return view('user.layanan.klik-home.payment.success');
    }
}
