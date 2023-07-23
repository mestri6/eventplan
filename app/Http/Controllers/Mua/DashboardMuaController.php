<?php

namespace App\Http\Controllers\Mua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardMuaController extends Controller
{
    public function index()
    {
        return view('pages.mua.dashboard');
    }
}
