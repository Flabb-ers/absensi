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
    {   $prodis = Prodi::all();
        $semesters = Semester::all();
        $kelass = Kelas::all();
        return view('pages.data-master.daftar-kelas',compact('prodis','semesters','kelass'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json([
        //     'success' => 'Kelas berhasil ditambahkan!',
        //     'kelas' => [
        //         'id' => 1, 
        //         'nama_kelas' => 'TI1A',
        //         'semester' => [
        //             'semester' => 1
        //         ],
        //         'jenis_kelas' => 'Reguler'
        //     ]
        // ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
