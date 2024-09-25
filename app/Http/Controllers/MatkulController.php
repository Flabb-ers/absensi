<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matkuls = Matkul::with('kelas.semester', 'dosen', 'ruangan')->get();
        $dosens = Dosen::all();
        $kelass = Kelas::with('prodi', 'semester')->get();
        $ruangans = Ruangan::all();
        return view('pages.data-master.matkul', compact('matkuls', 'dosens', 'kelass', 'ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer',
            'kelas_id' => 'required|exists:kelas,id',
            'dosens_id' => 'required|exists:dosens,id',
            'ruangans_id' => 'required|exists:ruangans,id',
        ], [
            'nama_matkul.required' => 'Nama mata kuliah harus diisi',
            'sks.required' => 'SKS harus diisi',
            'sks.integer' => 'SKS harus berupa angka',
            'kelas_id.required' => 'Kelas harus dipilih',
            'kelas_id.exists' => 'Kelas tidak valid',
            'dosens_id.required' => 'Dosen harus dipilih',
            'dosens_id.exists' => 'Dosen tidak valid',
            'ruangans_id.required' => 'Ruangan harus dipilih',
            'ruangans_id.exists' => 'Ruangan tidak valid',
        ]);

        Matkul::create([
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
            'kelas_id' => $request->kelas_id,
            'dosens_id' => $request->dosens_id,
            'ruangans_id' => $request->ruangans_id,
        ]);

        return response()->json(['success' => 'Data mata kuliah berhasil ditambahkan']);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1',
            'dosen_id' => 'required|exists:dosens,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nama_matkul.required' => 'Nama mata kuliah wajib diisi',
            'sks.required' => 'SKS wajib diisi',
            'dosens_id.required' => 'Dosen wajib dipilih',
            'ruangans_id.required' => 'Ruangan wajib dipilih',
            'kelas_id.required' => 'Kelas wajib dipilih',
        ]);

        $matkul = Matkul::findOrFail($id);
        $matkul->update([
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
            'dosens_id' => $request->dosen_id,
            'ruangans_id' => $request->ruangan_id,
            'kelas_id' => $request->kelas_id,
        ]);

        return response()->json(['success' => 'Mata kuliah berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matkul = Matkul::findOrFail($id);
        $matkul->delete();
        return response()->json(['success'=>'Mata kuliah berhasil dihapus']);
    }
}
