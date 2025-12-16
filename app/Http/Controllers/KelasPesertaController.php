<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasPesertaController extends Controller
{
    public function index(Kelas $kelas)
    {
        $siswa = Siswa::all();
        $peserta = $kelas->siswa->pluck('id')->toArray();

        return view('admin.kelas.peserta', compact('kelas','siswa','peserta'));
    }

    public function store(Request $request, Kelas $kelas)
    {
        $request->validate([
            'siswa_id' => 'required|array'
        ]);

        $kelas->siswa()->sync($request->siswa_id);

        return redirect()
            ->route('kelas.peserta', $kelas->id)
            ->with('success', 'Peserta kelas berhasil disimpan!');
    }

}
