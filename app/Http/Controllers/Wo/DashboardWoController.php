<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardWoController extends Controller
{
    public function index()
    {
        return view('pages.wo.dashboard');
    }
}
