<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\DataGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasGuruController extends Controller
{
    private function guruLogin()
    {
        $user = Auth::user();
        return DataGuru::where('email', $user->email)->firstOrFail();
    }

    public function index()
    {
        $guru = $this->guruLogin();

        $kelas = Kelas::where('guru_id', $guru->id)->get();
        return view('guru.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('guru.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required',
            'nama_kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $guru = $this->guruLogin();

        Kelas::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'guru_id' => $guru->id,
            'status_aktif' => 1,
        ]);

        return redirect()->route('guru.kelas.index')->with('success','Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kelas)
    {
        $guru = $this->guruLogin();
        abort_if($kelas->guru_id != $guru->id, 403);

        return view('guru.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $guru = $this->guruLogin();
        abort_if($kelas->guru_id != $guru->id, 403);

        $kelas->update($request->only([
            'kode_kelas','nama_kelas','hari','jam_mulai','jam_selesai','status_aktif'
        ]));

        return redirect()->route('guru.kelas.index')->with('success','Kelas diperbarui');
    }

    public function destroy(Kelas $kelas)
    {
        $guru = $this->guruLogin();
        abort_if($kelas->guru_id != $guru->id, 403);

        $kelas->delete();
        return back()->with('success','Kelas dihapus');
    }

    // ================= PESERTA =================
    public function peserta(Kelas $kelas)
    {
        $guru = $this->guruLogin();
        abort_if($kelas->guru_id != $guru->id, 403);

        $siswa = Siswa::all();
        $peserta = $kelas->siswa->pluck('id')->toArray();

        return view('guru.kelas.peserta', compact('kelas','siswa','peserta'));
    }

    public function simpanPeserta(Request $request, Kelas $kelas)
    {
        $guru = $this->guruLogin();
        abort_if($kelas->guru_id != $guru->id, 403);

        $kelas->siswa()->sync($request->siswa_id ?? []);
        return back()->with('success','Peserta diperbarui');
    }
}
