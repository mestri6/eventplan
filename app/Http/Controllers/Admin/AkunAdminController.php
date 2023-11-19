<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AkunAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = User::findOrFail(Auth::user()->id);

        if ($request->isMethod('post')) {
            $item->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect()->back();
        }

        return view('pages.admin.akun', compact('item'));
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
        $data = $request->all();

        if ($request->hasFile('foto_profile')) {
            if (Auth::user()->foto_profile != null) {
                Storage::disk('public')->delete(Auth::user()->foto_profile);
                $data['foto_profile'] = $request->file('foto_profile')->store('assets/user', 'public');
            } else {
                $data['foto_profile'] = $request->file('foto_profile')->store('assets/user', 'public');
            }
        }

        $item = User::findOrFail($id);
        $item->update($data);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('akun-admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
