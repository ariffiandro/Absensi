<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function store(Request $request, $kelasId)
    {
        $user = auth()->user();

        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        $kelas = Kelas::findOrFail($kelasId);

        // ❌ cek jam
        if (!$kelas->isAktifSekarang()) {
            return back()->with('error', 'Belum waktunya absen');
        }

        // ❌ cegah dobel
        $sudahAbsen = Absensi::where('siswa_id', $siswa->id)
            ->where('kelas_id', $kelas->id)
            ->whereDate('tanggal', Carbon::today())
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Kamu sudah absen hari ini');
        }

        // ✅ SIMPAN KE DATABASE
        Absensi::create([
            'siswa_id'  => $siswa->id,
            'kelas_id'  => $kelas->id,
            'tanggal'   => Carbon::today(),
            'jam_absen' => Carbon::now('Asia/Jakarta')->format('H:i:s'),
            'status'    => 'Hadir',
        ]);

        return back()->with('success', 'Absen berhasil');
    }
}
