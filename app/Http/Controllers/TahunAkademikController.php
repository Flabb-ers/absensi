<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahuns = TahunAkademik::all();
        return view('pages.data-master.tahun-akademik', compact('tahuns'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi format tahun akademik
        $validateData = $request->validate([
            'tahun_akademik' => [
                'required',
                'regex:/^[0-9]{4}\/[0-9]{4}$/'
            ]
        ], [
            'tahun_akademik.required' => 'Tahun akademik wajib diisi',
            'tahun_akademik.regex' => 'Format tahun akademik tidak valid [YYYY/YYYY]'
        ]);

        $tahun = explode('/', $request->tahun_akademik);
        $tahunPertama = (int) $tahun[0];
        $tahunKedua = (int) $tahun[1];

        if ($tahunKedua <= $tahunPertama) {
            return response()->json([
                'errors' => ['tahun_akademik' => ['Tahun kedua harus lebih besar dari tahun pertama']]
            ], 422);
        }

        $tahunAkademik = TahunAkademik::create([
            'tahun_akademik' => $request->tahun_akademik,
        ]);

        return response()->json(['success' => 'Tahun akademik berhasil ditambahkan', 'tahun' => $tahunAkademik]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tahun_akademik' => [
                'required',
                'regex:/^[0-9]{4}\/[0-9]{4}$/'
            ]
        ], [
            'tahun_akademik.required' => 'Tahun akademik wajib diisi.',
            'tahun_akademik.regex' => 'Format tahun akademik tidak valid [YYYY/YYYY]'
        ]);

        $tahunAkademik = TahunAkademik::findOrFail($id);
        $tahunAkademik->update([
            'tahun_akademik' => $validateData['tahun_akademik']
        ]);

        return response()->json(['success' => 'Tahun akademik berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAkademik $tahunAkademik)
    {
        $hapus = TahunAkademik::findOrFail($tahunAkademik->id);
        
        $hapus->delete();
        return response()->json(['success','Tahun akademik berhasil dihapus']);
    }
}
