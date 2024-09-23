<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = Dosen::all();
        return view('pages.data-master.data-dosen', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validateData = $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|numeric|unique:dosens,nidn',
            'jenis_kelamin' => 'required|string',
            'no_telephone' => 'required|string|max:15',
            'agama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'email' => 'required|email|unique:dosens,email',
            'password' => 'required|string|min:8',
        ], [
            'nama.required' => 'Nama Dosen harus diisi.',
            'nidn.required' => 'NIDN harus diisi.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'no_telephone.required' => 'Nomor WhatsApp harus diisi.',
            'agama.required' => 'Agama harus dipilih.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        Dosen::create([
            'nama' => $validateData['nama'],
            'nidn' => $validateData['nidn'],
            'jenis_kelamin' => $validateData['jenis_kelamin'],
            'no_telephone' => $validateData['no_telephone'],
            'agama' => $validateData['agama'],
            'tanggal_lahir' => $validateData['tanggal_lahir'],
            'tempat_lahir' => $validateData['tempat_lahir'],
            'email' => $validateData['email'],
            'status' => 1,
            'password' => Hash::make($validateData['password']),
        ]);

        return response()->json(['success' => 'Data dosen berhasil ditambahkan!'], 200);
    }



    public function update(Request $request, $id)
    {
        // Mencari dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Validasi input dengan pesan kustom
        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'no_telephone' => 'required|string|max:15',
            'agama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($dosen) {
                    if ($value !== $dosen->email && Dosen::where('email', $value)->exists()) {
                        $fail('Email sudah terdaftar.');
                    }
                },
            ],
        ], [
            'nama.required' => 'Nama dosen harus diisi.',
            'nidn.required' => 'NIDN harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'no_telephone.required' => 'Nomor WhatsApp harus diisi.',
            'agama.required' => 'Agama harus dipilih.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'status.required' => 'Status harus dipilih.',
        ]);

        $dosen->update([
            'nama' => $request->input('nama'),
            'nidn' => $request->input('nidn'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_telephone' => $request->input('no_telephone'),
            'agama' => $request->input('agama'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'email' => $request->input('email'),
            'status' => $request->input('status'),
        ]);

        return response()->json(['success' => 'Data dosen berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return response()->json(['success' => 'Dosen berhasil dihapus.']);
    }
}
