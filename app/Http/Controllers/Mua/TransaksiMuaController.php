<?php

namespace App\Http\Controllers\Mua;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiMuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::whereHas('layanan', function ($query) {
                $query->where('id_user', Auth::user()->id);
            })->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('id_user', function ($item) {
                    return $item->user->name ?? '-';
                })
                ->editColumn('status_pembayaran', function ($item) {
                    if ($item->status_pembayaran == 'tertunda') {
                        return '<span class="badge badge-warning">' . $item->status_pembayaran . '</span>';
                    } elseif ($item->status_pembayaran == 'berhasil') {
                        return '<span class="badge badge-success">' . $item->status_pembayaran . '</span>';
                    } elseif ($item->status_pembayaran == 'gagal') {
                        return '<span class="badge badge-danger">' . $item->status_pembayaran . '</span>';
                    }
                })
                ->editColumn('action', function ($item) {
                    if ($item->status_pembayaran == 'berhasil') {
                        return '
                            <div class="d-flex">
                                <a href="' . route('transaksi-mua.show', $item->id_transaksi) . '" class="btn btn-sm btn-primary mx-2">
                                    <i class="fa fa-eye"></i>
                                </a>
                            <button class="btn btn-success text-white mx-2" disabled>Selesai Diproses</button>
                            </div>
                        ';
                    } else {
                        return '
                            <div class="d-flex">
                                <a href="' . route('transaksi-mua.show', $item->id_transaksi) . '" class="btn btn-sm btn-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <button class="btn btn-warning text-white" disabled>Sedang Diproses</button>
                            </div>
                        ';
                    }
                })
                ->rawColumns(['alamat', 'thumbnail', 'action', 'status_pembayaran'])
                ->make(true);
        }
        return view('pages.mua.transaksi.index');
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
        $item = Transaction::with(['user'])->findOrFail($id);
        return view('pages.mua.transaksi.show', [
            'item' => $item
        ]);
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
