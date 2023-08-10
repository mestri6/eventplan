<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

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
