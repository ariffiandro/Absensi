<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis',
            'email' => 'required|email|unique:siswa,email|unique:users,email',
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
        ]);

        // 1️⃣ Simpan ke tabel siswa
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        // 2️⃣ Buat akun login otomatis di tabel users
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->nis), // password default = NIS
            'role' => 'siswa',
        ]);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan dan akun login dibuat!');
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis,' . $siswa->id,
            'email' => 'required|email|unique:siswa,email,' . $siswa->id,
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $siswa->update($request->all());

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        // Hapus juga user login siswa
        User::where('email', $siswa->email)->delete();

        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa dan akun login berhasil dihapus!');
    }
}
