<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Layanan;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = Layanan::with(['galleries', 'user'])->get();

        return view('home', compact('layanan'));
    }

    public function detailLayanan(Request $request, $id)
    {
        if (request()->ajax()) {
            $layanan = Layanan::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
            $query = Transaction::with(['user', 'layanan'])->where('id_layanan', $layanan->id_layanan)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('id_user', function ($item) {
                    return $item->user->name ?? '-';
                })
                ->editColumn('id_layanan', function ($item) {
                    return $item->layanan->nama_layanan ?? '-';
                })
                ->editColumn('tanggal_acara', function ($item) {
                    return Carbon::parse($item->tanggal_acara)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('total_harga', function ($item) {
                    return 'Rp. ' . number_format($item->total_pembayaran, 0, ',', '.');
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $item = Layanan::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        return view('detail', [
            'item' => $item,
        ]);
    }
}
