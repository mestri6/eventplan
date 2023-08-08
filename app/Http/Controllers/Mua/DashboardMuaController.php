<?php

namespace App\Http\Controllers\Mua;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardMuaController extends Controller
{
    public function index()
    {
        // untuk menghitung layanan yang di miliki oleh pemilik akun
        $layanan = Layanan::where('users_id', Auth::user()->id)->count();
        return view('pages.mua.dashboard', compact('layanan'));
    }
}
