<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DataGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiGuruController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $guru = DataGuru::where('email', $user->email)->first();
        if (!$guru) {
            abort(403, 'Akun guru belum terdaftar');
        }

        $absensi = Absensi::with(['siswa', 'kelas'])
            ->whereHas('kelas', function ($q) use ($guru, $request) {
                $q->where('guru_id', $guru->id);

                // 🔍 FILTER NAMA KELAS
                if ($request->kelas) {
                    $q->where('nama_kelas', 'like', '%' . $request->kelas . '%');
                }
            });

        // 🔍 FILTER TANGGAL
        if ($request->tanggal) {
            $absensi->whereDate('tanggal', $request->tanggal);
        }

        $absensi = $absensi
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_absen', 'desc')
            ->get();

        return view('guru.absensi.index', compact('absensi'));
    }
}
