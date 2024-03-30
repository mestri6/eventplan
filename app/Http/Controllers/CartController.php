<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Layanan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Cart::with(['user', 'layanan'])->where('id_user', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('id_layanan', function ($item) {
                    return $item->layanan->nama_layanan ?? '-';
                })
                ->editColumn('total_harga', function ($item) {
                    return 'Rp. ' . number_format($item->total_harga, 0, ',', '.');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-danger" onClick="deleteCart(
                            ' . $item->id_keranjang . '
                        )">
                            Hapus
                        </a>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action'])
                ->make(true);
        }

        $kodeUnik = mt_rand(100, 999);
        $harga = Cart::where('id_user', Auth::user()->id)->sum('total_harga');


        $totalPembayaran = $harga + $kodeUnik;
        $countCart = Cart::where('id_user', Auth::user()->id)->count();
        return view('cart', compact('kodeUnik', 'harga', 'totalPembayaran', 'countCart'));
    }

    public function addToCart(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $data = Cart::create([
            'id_user' => Auth::user()->id,
            'id_layanan' => $id,
            'total_harga' => $layanan->harga,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Layanan berhasil ditambahkan ke keranjang');
            return redirect()->route('cart');
        } else {
            Alert::error('Gagal', 'Layanan gagal ditambahkan ke keranjang');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $cart = Cart::findOrFail($request->id);
        $cart->delete();

        if ($cart) {
            return response()->json([
                'success' => true,
                'message' => 'Layanan berhasil dihapus dari keranjang'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Layanan gagal dihapus dari keranjang'
            ]);
        }
    }

    public function checkTanggal(Request $request)
    {
        $twoDaysBefore = date('Y-m-d', strtotime('-2 days', strtotime($request->tanggal_acara)));
        $twoDaysAfter = date('Y-m-d', strtotime('+2 days', strtotime($request->tanggal_acara)));

        $query = Transaction::select('tanggal_acara')->whereBetween('tanggal_acara', [$twoDaysBefore, $twoDaysAfter])->first();


        if ($query) {
            return response()->json([
                'status' => false,
                'message' => 'Tanggal acara sudah dibooking oleh customer lain, silahkan pilih tanggal lain'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Tanggal acara tersedia'
            ]);
        }

        return response()->json($query);
    }
}
