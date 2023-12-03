<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function process(Request $request)
    {
        //
    }
}
