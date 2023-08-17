<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::where('users_id', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('transaksi-customer.show', $item->id) . '" class="btn btn-sm btn-primary">
                            <i class="fa fa-eye"></i>
                        </a>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action'])
                ->make(true);
        }
        return view('pages.customer.transaksi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
