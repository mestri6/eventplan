<?php

namespace App\Http\Controllers\Mua;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardMuaController extends Controller
{
    public function index()
    {
        $layanan = Layanan::where('id_user', Auth::user()->id)->count();
        $income = Transaction::whereHas('layanan', function ($layanan) {
            $layanan->where('id_user', Auth::user()->id)->where('status_pembayaran', 'berhasil');
        })->sum('total_pembayaran');
        $countOrder = Transaction::whereHas('layanan', function ($layanan) {
            $layanan->where('id_user', Auth::user()->id)->where('status_pembayaran', 'berhasil');
        })->count();
        return view('pages.mua.dashboard', compact('layanan', 'income', 'countOrder'));
    }
}
