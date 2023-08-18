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
                ->editColumn('users_id', function ($item) {
                    return $item->user->name ?? '-';
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
                    if($item->bukti_pembayaran != null){
                        return '
                            <button class="btn btn-warning text-white" disabled>Sedang Diproses</button>
                        ';
                    }else{
                        return '
                            <a href="' . route('transaksi-customer.show', $item->id) . '" class="btn btn-sm btn-primary">
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
        $item = Transaction::findOrFail($id);

        if ($item->bukti_pembayaran != null) {
            return abort(404);
        }else{
            return view('pages.customer.transaksi-detail', compact('item'));
        }

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
        $data = Transaction::findOrFail($request->id);

        $data->update([
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('assets/bukti-pembayaran', 'public'),
        ]);

        if ($data) {
            return redirect()->route('transaksi-customer.index');
        } else {
            return redirect()->back();
        }
    }
}
