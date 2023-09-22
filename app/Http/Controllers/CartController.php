<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Cart::with(['user', 'layanan'])->where('users_id', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('layanan_id', function($item) {
                    return $item->layanan->nama_paket ?? '-';
                })
                ->editColumn('total_harga', function($item) {
                    return 'Rp. ' . number_format($item->total_harga, 0, ',', '.');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-danger" onClick="deleteCart(
                            ' . $item->id . '
                        )">
                            Hapus
                        </a>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action'])
                ->make(true);
        }
        
        $kodeUnik = mt_rand(100, 999);
        $harga = Cart::where('users_id', Auth::user()->id)->sum('total_harga');

        
        $totalPembayaran = $harga + $kodeUnik;

        return view('cart', compact('kodeUnik', 'harga', 'totalPembayaran'));
    }

    public function addToCart( Request $request ,$id)
    {
        $layanan = Layanan::findOrFail($id);
        $data = Cart::create([
            'users_id' => Auth::user()->id,
            'layanan_id' => $id,
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
}
