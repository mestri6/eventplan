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
}
