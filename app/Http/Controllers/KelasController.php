<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Semester;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all();
        $semesters = Semester::all();
        $kelass = Kelas::with(['semester', 'prodi'])->get();
        return view('pages.data-master.daftar-kelas', compact('prodis', 'semesters', 'kelass'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required',
            'id_semester' => 'required',
            'jenis_kelas' => 'required'
        ], [
            'id_prodi.required' => 'Prodi harus dipilih',
            'id_semester.required' => 'Semester harus dipilih',
            'jenis_kelas.required' => 'Jenis kelas harus dipilih'
        ]);

        $prodi = Prodi::findOrFail($request->id_prodi);
        $semester = Semester::findOrFail($request->id_semester);
        $namaKelas = $prodi->singkatan . ' ' . $semester->semester . ($request->jenis_kelas === 'Reguler' ? 'A' : 'B');


        $kelas = Kelas::create([
            'id_prodi' => $request->id_prodi,
            'id_semester' => $request->id_semester,
            'jenis_kelas' => $request->jenis_kelas,
            'nama_kelas' => $namaKelas,
        ]);

        return response()->json([
            'success' => 'Kelas berhasil ditambahkan!',
            'kelas' => [
                'id' => $kelas->id,
                'nama_kelas' => $kelas->nama_kelas,
                'jenis_kelas' => $kelas->jenis_kelas,
                'nama_prodi' => [
                    'nama_prodi' => $prodi->nama_prodi
                ],
                'semester' => [
                    'semester' => $semester->semester
                ]
            ]
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_prodi' => 'required',
            'id_semester' => 'required',
            'jenis_kelas' => 'required'
        ]);

        $kelas = Kelas::findOrFail($id);
        $prodi = Prodi::findOrFail($request->id_prodi);
        $semester = Semester::findOrFail($request->id_semester);

        // Update kelas
        $kelas->update([
            'id_prodi' => $request->id_prodi,
            'id_semester' => $request->id_semester,
            'jenis_kelas' => $request->jenis_kelas,
            'nama_kelas' => $prodi->singkatan . ' ' . $semester->semester . ($request->jenis_kelas === 'Reguler' ? 'A' : 'B'),
        ]);

        return response()->json([
            'success' => 'Kelas berhasil diperbarui!',
            'kelas' => [
                'id' => $kelas->id,
                'nama_kelas' => $kelas->nama_kelas,
                'jenis_kelas' => $kelas->jenis_kelas,
                'nama_prodi' => $prodi->nama_prodi,
                'semester' => $semester->semester,
            ]
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hapus = Kelas::findOrFail($id);
        $hapus->delete();
        return response()->json([
            'success' => 'Kelas berhasil dihapus!',
        ]);
    }
}
