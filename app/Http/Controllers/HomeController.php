<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $item = Layanan::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        return view('detail', [
            'item' => $item,
        ]);
    }

    public function addToCart(Request $request)
    {
        $data = Cart::create([
            'users_id' => Auth::user()->id,
            'layanan_id' => $request->layanan_id,
            'total_harga' => $request->total_harga,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Layanan berhasil ditambahkan ke keranjang');
            return redirect()->route('cart');
        } else {
            Alert::error('Gagal', 'Layanan gagal ditambahkan ke keranjang');
            return redirect()->back();
        }
    }
}
