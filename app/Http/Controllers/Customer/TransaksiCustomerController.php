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
            $query = Transaction::where('id_user', Auth::user()->id)->get();

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
                    if($item->status_pembayaran == 'berhasil'){
                        return '
                            <div class="d-flex">
                                <a href="' . route('customer.detail-transaksi', $item->id_transaksi) . '" class="btn btn-sm btn-primary mx-2">
                                <i class="fa fa-eye"></i>
                            </a>
                            <button class="btn btn-success text-white mx-2" disabled>Selesai Diproses</button>
                            </div>
                        ';
                    }elseif ($item->bukti_pembayaran != null) {
                        return '
                            <div class="d-flex justofy-content-center align-items-center">
                                <a href="' . route('customer.detail-transaksi', $item->id_transaksi) . '" class="btn btn-primary mx-2">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button class="btn btn-warning text-white disabled">Sedang Diproses</button>
                            </div>
                        ';
                    }
                    else{
                        return '
                            <div class="d-flex">
                                <a href="' . route('customer.detail-transaksi', $item->id_transaksi) . '" class="btn btn-sm btn-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                        ';
                    }
                })
                ->rawColumns(['alamat', 'thumbnail', 'action', 'status_pembayaran'])
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

    public function uploadPembayaran(Request $request)
    {
        $data = Transaction::findOrFail($request->id_transaksi);

        $data->update([
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('assets/bukti-pembayaran', 'public'),
        ]);

        if ($data) {
            return redirect()->route('transaksi-customer.index');
        } else {
            return redirect()->back();
        }
    }

    public function detailTransaksi($id)
    {
        $item = Transaction::with('layanan')->findOrFail($id);
        return view('pages.customer.transaksi-detail', compact('item'));
    }
}
