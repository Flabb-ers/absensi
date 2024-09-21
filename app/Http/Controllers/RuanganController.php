<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('pages.data-master.ruang', compact('ruangans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required'
        ],['nama.required'=>'Nama ruangan harus diisi']);

        $ruangan = Ruangan::create([
            'nama' => $validateData['nama']
        ]);

        return response()->json([
            'success' => 'Ruangan berhasil ditambahkan',
            'ruangan' => $ruangan
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $edit = Ruangan::findOrFail($ruangan->id);

        $validateData = $request->validate([
            'nama' => 'required'
        ],['nama.required'=>'Nama ruangan harus diisi']);

        $edit->update($validateData);
        return response()->json(['success'=>'Ruangan berhasil diedit']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return response()->json(['success'=>'Ruangan berhasil dihapus']);
    }
}
