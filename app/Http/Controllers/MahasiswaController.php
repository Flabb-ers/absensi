<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with('kelas.semester')->get();
        // dd($mahasiswas);
        $kelass = Kelas::with('prodi', 'semester')->get();
        return view('pages.data-mahasiswa.index', compact('mahasiswas', 'kelass'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required|unique:mahasiswas,nim',
            'nisn' => 'required|unique:mahasiswas,nisn',
            'nik' => 'required|unique:mahasiswas,nik',
            'email' => 'required|email|unique:mahasiswas,email',
            'alamat' => 'required',
            'no_telephone' => 'required|unique:mahasiswas,no_telephone',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'nama_ibu' => 'required',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nim.required' => 'NIM harus diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nik.required' => 'NIK harus diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'alamat.required' => 'Alamat harus diisi',
            'no_telephone.required' => 'Nomor telepon harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'nama_ibu.required' => 'Nama Ibu harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'kelas_id.required' => 'Kelas harus dipilih',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid',
        ]);

        Mahasiswa::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telephone' => $request->no_telephone,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'nama_ibu' => $request->nama_ibu,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas_id' => $request->kelas_id
        ]);

        return response()->json(['success' => 'Mahasiswa berhasil ditambahkan']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    
    $mahasiswa = Mahasiswa::findOrFail($id);

    $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'nim' => 'required|numeric',
        'nisn' => 'required|numeric',
        'nik' => 'required|numeric',
        'email' => 'required|email|max:255',
        'alamat' => 'required|string',
        'no_telephone' => 'required|numeric',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255',
        'nama_ibu' => 'required|string|max:255',
        'jenis_kelamin' => 'required|string',
        'kelas_id' => 'required|exists:kelas,id',
    ];


    if ($request->nim !== $mahasiswa->nim) {
        $rules['nim'] .= '|unique:mahasiswas,nim';
    }
    if ($request->nisn !== $mahasiswa->nisn) {
        $rules['nisn'] .= '|unique:mahasiswas,nisn';
    }
    if ($request->nik !== $mahasiswa->nik) {
        $rules['nik'] .= '|unique:mahasiswas,nik';
    }
    if ($request->email !== $mahasiswa->email) {
        $rules['email'] .= '|unique:mahasiswas,email';
    }
    if ($request->no_telephone !== $mahasiswa->no_telephone) {
        $rules['no_telephone'] .= '|unique:mahasiswas,no_telephone';
    }

    $request->validate($rules, [
        'nama_lengkap.required' => 'Nama lengkap harus diisi',
        'nim.required' => 'NIM harus diisi',
        'nim.unique' => 'NIM sudah terdaftar',
        'nim.numeric' => 'NIM harus berupa angka',
        'nisn.required' => 'NISN harus diisi',
        'nisn.unique' => 'NISN sudah terdaftar',
        'nisn.numeric' => 'NISN harus berupa angka',
        'nik.required' => 'NIK harus diisi',
        'nik.unique' => 'NIK sudah terdaftar',
        'nik.numeric' => 'NIK harus berupa angka',
        'email.required' => 'Email harus diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'alamat.required' => 'Alamat harus diisi',
        'no_telephone.required' => 'Nomor telepon harus diisi',
        'no_telephone.unique' => 'Nomor telepon sudah terdaftar',
        'no_telephone.numeric' => 'Nomor telepon harus berupa angka',
        'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
        'tempat_lahir.required' => 'Tempat lahir harus diisi',
        'nama_ibu.required' => 'Nama Ibu harus diisi',
        'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
        'kelas_id.required' => 'Kelas harus dipilih',
        'kelas_id.exists' => 'Kelas yang dipilih tidak valid',
    ]);

    $mahasiswa->update($request->all());

    return response()->json(['success' => 'Data mahasiswa berhasil diperbarui'], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Mencari mahasiswa berdasarkan ID
    $mahasiswa = Mahasiswa::findOrFail($id);

    // Menghapus data mahasiswa
    $mahasiswa->delete();

    return response()->json(['message' => 'Data mahasiswa berhasil dihapus'], 200);
}

}
