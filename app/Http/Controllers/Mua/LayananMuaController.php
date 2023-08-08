<?php

namespace App\Http\Controllers\Mua;

use App\Http\Controllers\Controller;
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
                    return $item->thumbnail ? '<img src="' . url('storage/' . $item->thumbnail) . '" style="max-height: 50px;" />' : '-';
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
        $data['thumbnail'] = $request->file('thumbnail')->store(
            'assets/layanan',
            'public'
        );
        $data['slug'] = Str::slug($request->nama_paket);
        $data['harga'] = str_replace(['Rp. ', '.'], ['', ''], $request->harga);

        $item = Layanan::create($data);

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
        return view('pages.mua.layanan.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->nama_paket);
        $data['harga'] = str_replace(['Rp. ', '.'], ['', ''], $request->harga);

        $item = Layanan::findOrFail($id);

        if ($request->file('thumbnail')) {
            if ($item->thumbnail && file_exists(storage_path('app/public/' . $item->thumbnail))) {
                Storage::delete('public/' . $item->thumbnail);
            } else {
                $data['thumbnail'] = $item->thumbnail;
            }

            $data['thumbnail'] = $request->file('thumbnail')->store(
                'assets/layanan',
                'public'
            );
        } else {
            $data['thumbnail'] = $item->thumbnail;
        }

        if ($item->update($data)) {
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
