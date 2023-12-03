<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardWoController extends Controller
{
    public function index()
    {
        // untuk menghitung layanan yang di miliki oleh pemilik akun
        $layanan = Layanan::where('id_user', Auth::user()->id)->count();
        $income = Transaction::whereHas('layanan', function ($layanan) {
            $layanan->where('id_user', Auth::user()->id)->where('status_pembayaran', 'berhasil');
        })->sum('total_pembayaran');
        $countOrder = Transaction::whereHas('layanan', function ($layanan) {
            $layanan->where('id_user', Auth::user()->id)->where('status_pembayaran', 'berhasil');
        })->count();
        return view('pages.wo.dashboard', compact('layanan', 'income', 'countOrder'));
    }
}
