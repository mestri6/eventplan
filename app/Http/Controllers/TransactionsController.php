<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function checkout(Request $request)
    {
        $data = Transaction::create([
            'users_id' => Auth::user()->id,
            'tanggal_acara' => $request->tanggal_acara,
            'alamat' => $request->alamat,
            'kode_unik' => $request->kode_unik,
            'total_pembayaran' => $request->total_pembayaran,
            'nomor_rekening' => '1234567890',
            'status_pembayaran' => 'pending',
        ]);

        Cart::where('users_id', Auth::user()->id)->delete();

        if ($data) {
            return redirect()->route('pembayaran');
        } else {
            return redirect()->back();
        }
    }

    public function success()
    {
        $data = Transaction::where('users_id', Auth::user()->id)->latest()->first();
        if ($data) {
            return view('success');
        } else {
            return abort(404);
        }
    }
}
