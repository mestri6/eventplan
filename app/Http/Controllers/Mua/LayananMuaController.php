<?php

namespace App\Http\Controllers\Mua;

use App\Http\Controllers\Controller;
use App\Models\GaleryLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class LayananMuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Layanan::where('users_id', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('harga', function ($item) {
                    return 'Rp. ' . number_format($item->harga, 0, ',', '.');
                })
                ->editColumn('thumbnail', function ($item) {
                    $galery = GaleryLayanan::where('layanan_id', $item->id)->first();
                    return $galery ? '<img src="' . url('storage/' . $galery->thumbnail) . '" style="max-height: 50px;" />' : '-';
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('layanan-mua.edit', $item->id) . '" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form action="' . route('layanan-mua.destroy', $item->id) . '" method="POST" style="display: inline-block;">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action'])
                ->make(true);
        }
        return view('pages.mua.layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mua.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->nama_paket);
        $data['harga'] = str_replace(['Rp. ', '.'], ['', ''], $request->harga); 

        $item = Layanan::create($data);

        // jika ada request thumbnail lpooping dan masukan data kedalam layanan galery
        if ($request->hasFile('thumbnail')) {
            // script ini akan menampilkan error jika foto yang di inputkan lebih dari 4
            if (count($request->file('thumbnail')) > 4) {
                Alert::error('Error', 'Mohon Maaf, Maksimal 4 Foto');
                return back();
            } else {
                // script ini akan looping dan menyimpan foto kedalam folder assets/layanan
                foreach ($request->file('thumbnail') as $file) {
                    $data = GaleryLayanan::create([
                        'layanan_id' => $item->id,
                        'thumbnail' => $file->store('assets/layanan', 'public')
                    ]);
                }
            }
        }

        if ($item->save()) {
            Alert::success('Success', 'Data Berhasil Ditambahkan');
            return redirect()->route('layanan-mua.index');
        } else {
            Alert::error('Error', 'Data Gagal Ditambahkan');
            return back();
        }
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
        $item = Layanan::findOrFail($id);
        $gallery = GaleryLayanan::where('layanan_id', $id)->get();
        return view('pages.mua.layanan.edit', compact('item', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Layanan::findOrFail($id);
        // jika file thumbnail ada maka looping file thumbnail dan simpan
        if ($request->hasFile('thumbnail')) {
            // script ini akan looping dan menyimpan foto kedalam folder assets/layanan
            foreach ($request->file('thumbnail') as $file) {
                $data = new GaleryLayanan;
                $data->layanan_id = $item->id;
                $data->thumbnail = $file->store('assets/layanan', 'public');
                $data->save();
            }
        }

        $simpan = $item->update([
            'nama_paket' => $request->nama_paket,
            'users_id' => Auth::user()->id,
            'slug' => Str::slug($request->nama_paket),
            'harga' => str_replace(['Rp. ', '.'], ['', ''], $request->harga)
        ]);

        if ($simpan) {
            Alert::success('Success', 'Data Berhasil Diubah');
            return redirect()->route('layanan-mua.index');
        } else {
            Alert::error('Error', 'Data Gagal Diubah');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // hapus data layanan ambil berdasarkan id
        $item = Layanan::findOrFail($id);

        if ($item->delete()) {
            Alert::success('Success', 'Data Berhasil Dihapus');
            return redirect()->route('layanan-mua.index');
        } else {
            Alert::error('Error', 'Data Gagal Dihapus');
            return back();
        }
    }
}
