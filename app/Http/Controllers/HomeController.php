<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Layanan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        // $layanan = Layanan::with(['galleries', 'user'])->get();

        $layanan = Layanan::with(['galleries', 'user'])->get();

        // $cekIdLayananTransaction = [];
        // foreach ($layanan as $item) {
        //     $cekIdLayananTransaction[] = $item->id;
        // }

        // $cekId = Transaction::where('layanan_id', $cekIdLayananTransaction)->first();


        // return view('home', compact('layanan', 'cekIdLayananTransaction', 'cekId'));
        return view('home', compact('layanan'));
    }

    public function detailLayanan(Request $request, $id)
    {

        $item = Layanan::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        // $cekId = Transaction::where('layanan_id', $item->id)->first();

        // if ($cekId) {
        //     return abort(404);
        // }

        
        return view('detail', [
            'item' => $item,
        ]);
    }
}
