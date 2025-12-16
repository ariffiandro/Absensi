<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataGuru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataGuruController extends Controller
{
    public function index()
    {
        $guru = DataGuru::all();
        return view('admin.data_guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.data_guru.create');
    }

    public function store(Request $request)
    {
        // 1️⃣ Validasi
        $request->validate([
            'nama'  => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'email' => 'required|email|unique:data_guru,email|unique:users,email',
        ]);

        // 2️⃣ Simpan ke tabel data_guru
        $guru = DataGuru::create([
            'nama'  => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
        ]);

        // 3️⃣ BUAT AKUN USER OTOMATIS
        User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make('password123'), // password default
            'role'     => 'guru',
        ]);

        return redirect()
            ->route('data_guru.index')
            ->with('success', 'Data guru berhasil ditambahkan & akun login dibuat');
    }

    public function edit($id)
    {
        $guru = DataGuru::findOrFail($id);
        return view('admin.data_guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = DataGuru::findOrFail($id);

        $request->validate([
            'nama'  => 'required',
            'kelas' => 'required',
            'email' => 'required|email|unique:data_guru,email,' . $id,
        ]);

        // Update data_guru
        $guru->update($request->only('nama', 'kelas', 'email'));

        // Update user juga
        User::where('email', $guru->email)->update([
            'name'  => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->route('data_guru.index')
            ->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        $guru = DataGuru::findOrFail($id);

        // Hapus user terkait
        User::where('email', $guru->email)->delete();

        // Hapus data guru
        $guru->delete();

        return redirect()->route('data_guru.index')
            ->with('success', 'Data guru & akun login dihapus');
    }
}
