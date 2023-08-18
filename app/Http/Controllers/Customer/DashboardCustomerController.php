<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardCustomerController extends Controller
{
    public function index()
    {
        $totalTransaksi = Transaction::where('users_id', Auth::user()->id)->sum('total_pembayaran');
        $totalOrder = Transaction::where('users_id', Auth::user()->id)->count();
        return view('pages.customer.dashboard', compact('totalTransaksi', 'totalOrder'));
    }

    public function upgrade()
    {
        $user = User::findOrFail(Auth::user()->id);
        $kategori = KategoriLayanan::all();
        return view('pages.customer.upgrade', compact('kategori', 'user'));
    }

    public function upgradeAkun(Request $request)
    {

        $data = User::findOrFail(Auth::user()->id);
        $data->no_wa = $request->no_wa;
        $data->nama_usaha = $request->nama_usaha;
        $data->foto_profile = $request->file('foto_profile')->store('assets/user', 'public');
        $data->foto_ktp = $request->file('foto_ktp')->store('assets/user', 'public');
        $data->surat_rtrw = $request->file('surat_rtrw')->store('assets/user', 'public');
        $data->foto_usaha = $request->file('foto_usaha')->store('assets/user', 'public');
        $data->alamat = $request->alamat;
        $data->id_kategori_layanan = $request->id_kategori_layanan;
        $data->status_akun = 'Meminta Verifikasi';

        $data->save();

        if ($data->save()) {
            Alert::success('Berhasil', 'Berhasil mengajukan verifikasi akun');
            return redirect()->route('customer.dashboard');
        } else {
            Alert::error('Gagal', 'Gagal mengajukan verifikasi akun');
            return redirect()->route('customer.dashboard');
        }
    }
}
