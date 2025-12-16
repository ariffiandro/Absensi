<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\DataGuru;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('guru')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $guru = DataGuru::all();
        return view('admin.kelas.create', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required',
            'nama_kelas' => 'required',
            'hari'       => 'required',
            'jam_mulai'  => 'required',
            'jam_selesai'=> 'required',
            'guru_id'    => 'nullable',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan');
    }

    // 🔥 EDIT – PAKAI ID BIASA (SAMA KAYAK GURU)
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $guru  = DataGuru::all();

        return view('admin.kelas.edit', compact('kelas','guru'));
    }

    // 🔥 UPDATE – PAKAI ID BIASA
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'kode_kelas' => 'required',
            'nama_kelas' => 'required',
            'hari'       => 'required',
            'jam_mulai'  => 'required',
            'jam_selesai'=> 'required',
            'guru_id'    => 'nullable',
            'status_aktif' => 'boolean',
        ]);

        $kelas->update($request->all());

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus');
    }
}
