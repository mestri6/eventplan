<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Illuminate\Support\Str;

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
        $data = $request->all();
        $data['id_user'] = Auth::id();
        $data['id_layanan'] = $request->id_layanan;

        $carts = Cart::with(['layanan', 'user'])
            ->where('id_user', Auth::user()->id)
            ->get();

        // create transaksi
        $transaction = Transaction::create([
            'id_layanan' => $carts[0]->id_layanan,
            'id_user' => Auth::user()->id,
            'tanggal_acara' => $request->tanggal_acara,
            'alamat' => $request->alamat,
            'kode_unik' => $request->kode_unik,
            'total_pembayaran' => $request->total_pembayaran - $request->kode_unik,
        ]);

        // delete cart data
        Cart::where('id_user', Auth::user()->id)->delete();

        Transaction::with(['layanan', 'user'])->where('id_user', Auth::user()->id)->first();

        $orderId = 'EVENT-' . $transaction->id . Str::random(5);
        $price = $transaction->total_pembayaran;

        $transaction->id_order = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price,
        ];

        $customer_details[] = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'nama_layanan' => $transaction->layanan->nama_layanan,
            'tanggal_acara' => $transaction->tanggal_acara,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details[0],
            'enabled_payments' => ['gopay'],
        ];

        try {
            // ambil halaman payment midtrans
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $transaction->midtrans_url = $paymentUrl;
            $transaction->save();
            // redirect ke halaman midtrans
            return redirect()->away($paymentUrl);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}