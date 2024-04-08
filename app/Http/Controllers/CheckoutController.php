<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Illuminate\Support\Str;
use Midtrans;

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
            'tanggal_awal_booking' => $request->tanggal_awal_booking,
            'tanggal_akhir_booking' => $request->tanggal_akhir_booking,
            'alamat' => $request->alamat,
            'kode_unik' => $request->kode_unik,
            'total_pembayaran' => $request->total_pembayaran - $request->kode_unik,
        ]);

        // delete cart data
        Cart::where('id_user', Auth::user()->id)->delete();

        Transaction::with(['layanan', 'user'])->where('id_user', Auth::user()->id)->first();

        $orderId = $transaction->id_transaksi . '-' . Str::random(5);
        $price = $transaction->total_pembayaran;

        $transaction->id_order = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price,
        ];

        $customer_details[] = [
            'first_name' => $transaction->user->name,
            'email' => $transaction->user->email,
            'phone' => $transaction->user->phone,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details[0],
            'enabled_payments' => ['bank_transfer'],
            'vtweb' => []
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

    public function callback(Request $request)
    {

        $notif = $request->method() == 'POST' ? new Midtrans\Notification() : Midtrans\Transaction::status($request->order_id);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $transaction_id = explode('-', $notif->order_id)[0];
        $transaction = Transaction::find($transaction_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $transaction->status_pembayaran = 'tertunda';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $transaction->status_pembayaran = 'berhasil';
            } else if ($transaction_status == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $transaction->status_pembayaran = 'gagal';
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->status_pembayaran = 'gagal';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->status_pembayaran = 'gagal';
            }
        } else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $transaction->status_pembayaran = 'gagal';
        } else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $transaction->status_pembayaran = 'berhasil';
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $transaction->status_pembayaran = 'tertunda';
        } else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaction->status_pembayaran = 'gagal';
        }

        $transaction->save();
        return view('success');
    }
}
