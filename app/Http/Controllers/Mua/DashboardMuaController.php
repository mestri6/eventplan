<?php

namespace App\Http\Controllers\Mua;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardMuaController extends Controller
{
    public function index()
    {
        $layanan = Layanan::where('users_id', Auth::user()->id)->count();
        $income = Transaction::whereHas('layanan', function ($layanan) {
            $layanan->where('users_id', Auth::user()->id)->where('status_pembayaran', 'success');
        })->sum('total_pembayaran');
        $countOrder = Transaction::whereHas('layanan', function ($layanan) {
            $layanan->where('users_id', Auth::user()->id)->where('status_pembayaran', 'success');
        })->count();
        return view('pages.mua.dashboard', compact('layanan'));
    }
}
