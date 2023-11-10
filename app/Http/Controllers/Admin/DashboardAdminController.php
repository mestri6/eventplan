<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function tablePengguna()
    {
        if (request()->ajax()) {
            $query = User::where('status_akun', 'Meminta Verifikasi')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('admin.show-pengguna', $item->id) . '" class="btn btn-sm btn-primary">
                            Detail Pengguna
                        </a>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action'])
                ->make(true);
        }
        return view('pages.admin.pengguna.index');
    }

    public function verifPengguna(Request $request)
    {
        $item = User::findOrFail($request->id);
        $item->status_akun = 'Terverifikasi';
        $item->role = $request->role;

        if ($item->save()) {
            Alert::success('Berhasil', 'Berhasil Verifikasi pengguna');
            return redirect()->route('admin.table-pengguna');
        } else {
            Alert::error('Gagal', 'Gagal Verifikasi pengguna');
            return redirect()->route('admin.table-pengguna');
        }
    }

    public function showVerifPenggua(string $id)
    {
        $item = User::with('kategori')->findOrFail($id);
        return view('pages.admin.pengguna.show', compact('item'));
    }

    public function tolakPengguna(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->status_akun = 'Ditolak';
        $data->alasan_penolakan = $request->alasan_penolakan;
        

        if($data->save()){
            Alert::success('Berhasil', 'Berhasil menolak pengguna');
            return redirect()->route('admin.table-pengguna');
        }else{
            Alert::error('Gagal', 'Gagal menolak pengguna');
            return redirect()->route('admin.table-pengguna');
        }
    }
}
