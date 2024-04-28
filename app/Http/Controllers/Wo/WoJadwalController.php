<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WoJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Jadwal::where('id_user', Auth::user()->id);

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('tanggal', function ($item) {
                    return Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <button class="btn btn-sm btn-primary" onclick="editData('. $item->id .')">
                            <i class="fa fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="hapusData('. $item->id .')">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.wo.jadwal.index');
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
        $data = Jadwal::updateOrCreate(
            ['id' => $request->id],
            [
                'id_user' => Auth::user()->id,
                'tanggal' => $request->tanggal,
            ]
        );

        if($data->wasRecentlyCreated){
            return response()->json(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
        } elseif($data->wasChanged()){
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data gagal disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = Jadwal::find($request->id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
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
    public function destroy(Request $request)
    {
        $data = Jadwal::find($request->id);
        $data->delete();

        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
