<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::with('roles')->get();
        return view('pages.data-master.user', compact('roles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'nama_user' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'],
            'nama_panjang' => ['required', 'string', 'regex:/^[a-zA-Z\s.]+$/'], // Mengizinkan titik
            'email' => ['required', 'email', 'unique:users,email'],
            'nip' => ['required', 'numeric', 'unique:users,nip'],
            'password' => ['required', 'min:8'],
            'roles' => ['required', 'array'],
        ], [
            'nama_user.required' => 'Nama user wajib diisi.',
            'nama_user.regex' => 'Nama user hanya boleh berisi huruf dan spasi.',
            'nama_panjang.required' => 'Nama panjang wajib diisi.',
            'nama_panjang.regex' => 'Nama panjang hanya boleh berisi huruf, spasi, dan titik.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nip.required' => 'NIP/NUPTK wajib diisi.',
            'nip.numeric' => 'NIP/NUPTK harus berupa angka.',
            'nip.unique' => 'NIP/NUPTK sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'roles.required' => 'Setidaknya satu role harus dipilih.',
        ]);

        // Membuat user baru
        $user = User::create([
            'nama_user' => $request->nama_user,
            'nama_panjang' => $request->nama_panjang,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
        ]);

        // Sinkronisasi roles
        $user->roles()->sync($request->roles);

        // Response sukses
        return response()->json([
            'success' => 'User berhasil ditambahkan.',
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama_user' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'],
            'nama_panjang' => ['required', 'string', 'regex:/^[a-zA-Z\s.]+$/'],

            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],

            'nip' => ['required', 'numeric', Rule::unique('users', 'nip')->ignore($user->id)],
            'roles' => ['required', 'array'],
        ], [
            'nama_user.required' => 'Nama user wajib diisi.',
            'nama_panjang.required' => 'Nama panjang wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nip.required' => 'NIP/NUPTK wajib diisi.',
            'nip.numeric' => 'NIP/NUPTK harus berupa angka.',
            'nip.unique' => 'NIP/NUPTK sudah terdaftar.',
            'roles.required' => 'Setidaknya satu role harus dipilih.',
        ]);

        $user->update([
            'nama_user' => $request->nama_user,
            'nama_panjang' => $request->nama_panjang,
            'email' => $request->email,
            'nip' => $request->nip,
        ]);


        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Sinkronisasi roles
        $user->roles()->sync($request->roles);

        return response()->json([
            'success' => 'User berhasil diupdate.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => 'User berhasil dihapus.']);
        }
        return response()->json(['error' => 'User tidak ditemukan.'], 404);
    }
}
