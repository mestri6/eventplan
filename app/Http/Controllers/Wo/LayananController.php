<?php

namespace App\Http\Controllers\Wo;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\LayananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Layanan::query();

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
                        <a href="'. route('layanan.edit', $item->id) .'" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form action="'. route('layanan.destroy', $item->id) .'" method="POST" style="display: inline-block;">
                            '. method_field('delete') . csrf_field() .'
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action'])
                ->make(true);
        }
        return view('pages.wo.layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.wo.layanan.create');
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
        $data['harga'] = str_replace('.', '', $request->harga);

        Layanan::create($data);

        return redirect()->route('layanan.index');
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
        return view('pages.wo.layanan.edit', [
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
        $data['harga'] = str_replace('.', '', $request->harga);

        $item = Layanan::findOrFail($id);

        $item->update($data);

        return redirect()->route('layanan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Layanan::findOrFail($id);
        $item->delete();

        return redirect()->route('layanan.index');
    }
}
