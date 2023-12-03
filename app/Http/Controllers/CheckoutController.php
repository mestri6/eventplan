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
            'first_name' => $transaction->user->name,
            'email' => $transaction->user->email,
            'phone' => $transaction->user->phone,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details[0],
            'payment' => [
                'gopay' => [
                    'enable_callback' => true,
                    'callback_url' => route('pembayaran-success-store'),
                ],
            ],
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

        $transaction_status = $notif->status_pembayaran;
        $fraud = $notif->fraud_status;

        $transaction_id = explode('-', $notif->order_id)[0];
        $transaction = Transaction::find($transaction_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $transaction->payment_status = 'PENDING';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $transaction->payment_status = 'DIBAYAR';
            } else if ($transaction_status == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $transaction->payment_status = 'KADALUARSA';
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->payment_status = 'KADALUARSA';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->payment_status = 'KADALUARSA';
            }
        } else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $transaction->payment_status = 'KADALUARSA';
        } else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $transaction->payment_status = 'DIBAYAR';
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $transaction->payment_status = 'PENDING';
        } else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaction->payment_status = 'KADALUARSA';
        }

        $transaction->save();
        return view('success');
    }
}
