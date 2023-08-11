<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // untuk menghitung jumlah pengguna kecuali admin
        $pengguna = User::whereNot('role', 'Admin')->count();

        // untuk menghitung jumlah layanan
        $layanan = Layanan::count();

        // untuk menghitung jumlah transaksi
        $transaksi = Transaction::count();
        return view('pages.admin.dashboard', compact('pengguna', 'layanan', 'transaksi'));
    }
}
