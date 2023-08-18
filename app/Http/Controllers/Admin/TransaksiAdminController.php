<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::query();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('users_id', function ($item) {
                    return $item->user->name ?? '-';
                })
                ->editColumn('bukti_pembayaran', function ($item) {
                    if ($item->bukti_pembayaran != null) {
                        return '<a href="' . Storage::url($item->bukti_pembayaran) . '" target="_blank">Lihat Bukti</a>';
                    } else {
                        return '-';
                    }
                })
                ->editColumn('status_pembayaran', function ($item) {
                    if ($item->status_pembayaran == 'pending') {
                        return '<span class="badge badge-warning">' . $item->status_pembayaran . '</span>';
                    } elseif ($item->status_pembayaran == 'success') {
                        return '<span class="badge badge-success">' . $item->status_pembayaran . '</span>';
                    } elseif ($item->status_pembayaran == 'failed') {
                        return '<span class="badge badge-danger">' . $item->status_pembayaran . '</span>';
                    }
                })
                ->editColumn('action', function ($item) {
                    if($item->status_pembayaran == 'success'){
                        return '
                            <div class="d-flex align-items-center">
                                <a href="' . route('transaksi-admin.show', $item->id) . '" class="btn btn-sm btn-primary mx-2">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-success mx-2" disabled>
                                    Selesai Verifikasi
                                </button>
                            </div>
                        ';
                    }else{
                        return '
                            <div class="d-flex align-items-center">
                                <a href="' . route('transaksi-admin.show', $item->id) . '" class="btn btn-sm btn-primary mx-2">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <form action="' . route('transaksi-admin.update', $item->id) . '" method="POST">
                                    ' . method_field('put') . csrf_field() . '
                                    <button type="submit" class="btn btn-sm btn-success mx-2">
                                        Verifikasi Pembayaran
                                    </button>
                                </form>
                            </div>
                        ';
                    }
                    return '
                        <div class="d-flex align-items-center">
                            <a href="' . route('transaksi-admin.show', $item->id) . '" class="btn btn-sm btn-primary mx-2">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="' . route('transaksi-admin.update', $item->id) . '" method="POST">
                                ' . method_field('put') . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-success mx-2">
                                    Verifikasi Pembayaran
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action', 'status_pembayaran', 'bukti_pembayaran'])
                ->make(true);
        }
        return view('pages.admin.transaksi');
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
        $item = Transaction::findOrFail($id);
        return view('pages.admin.transaksi-detail', compact('item'));
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

        $data = Transaction::findOrFail($id);
        $data->status_pembayaran = 'success';

        if($data->save()){
            Alert::success('Berhasil', 'Pembayaran berhasil diverifikasi');
            return redirect()->route('transaksi-admin.index');
        }else{
            Alert::error('Gagal', 'Pembayaran gagal diverifikasi');
            return redirect()->route('transaksi-admin.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
