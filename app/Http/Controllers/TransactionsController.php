<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionsController extends Controller
{
    public function checkout(Request $request)
    {
        $layanan = Cart::with(['user', 'layanan'])->where('id_user', Auth::user()->id)->pluck('id_layanan');
        $cekThreeDayBefore = date('Y-m-d', strtotime('+2 days', strtotime($request->tanggal_acara)));
        $cekThreeDayAfter = date('Y-m-d', strtotime('-3 days', strtotime($request->tanggal_acara)));
        $cekTransaction = Transaction::whereBetween('tanggal_acara', [$cekThreeDayAfter, $cekThreeDayBefore])->where('id_layanan', $layanan[0])->first();

        if ($cekTransaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tanggal tersebut sudah di booking, silahkan pilih tanggal lain',
            ]);
        }else{
            $data = Transaction::create([
                'id_layanan' => $layanan[0],
                'id_user' => Auth::user()->id,
                'tanggal_acara' => $request->tanggal_acara,
                'alamat' => $request->alamat,
                'kode_unik' => $request->kode_unik,
                'total_pembayaran' => $request->total_pembayaran - $request->kode_unik,
                'nomor_rekening' => '1234567890',
                'status_pembayaran' => 'tertunda',
            ]);

            Cart::where('id_user', Auth::user()->id)->delete();

            if ($data) {
                return redirect()->route('pembayaran');
            } else {
                return redirect()->back();
            }
        }
        
    }

    public function success()
    {
        $data = Transaction::where('id_user', Auth::user()->id)->latest()->first();
        if ($data) {
            return view('success');
        } else {
            return abort(404);
        }
    }
}
