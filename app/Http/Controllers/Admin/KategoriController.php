<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = KategoriLayanan::query();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('kategori.edit', $item->id) . '" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form action="' . route('kategori.destroy', $item->id) . '" method="POST" style="display: inline-block;">
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
        return view('pages.admin.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $item = KategoriLayanan::create($data);

        if ($item->save()) {
            Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
            return redirect()->route('kategori.index');
        } else {
            Alert::error('Error', 'Data Gagal Ditambahkan');
            return redirect()->route('kategori.create');
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
        $data = KategoriLayanan::findOrFail($id);
        return view('pages.admin.kategori.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $item = KategoriLayanan::findOrFail($id);

        if ($item->update($data)) {
            Alert::success('Berhasil', 'Data Berhasil Diubah');
            return redirect()->route('kategori.index');
        } else {
            Alert::error('Error', 'Data Gagal Diubah');
            return redirect()->route('kategori.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = KategoriLayanan::findOrFail($id);

        if ($item->delete()) {
            Alert::success('Berhasil', 'Data Berhasil Dihapus');
            return redirect()->route('kategori.index');
        } else {
            Alert::error('Error', 'Data Gagal Dihapus');
            return redirect()->route('kategori.index');
        }
    }
}
