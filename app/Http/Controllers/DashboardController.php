<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return view('siswa.dashboard', [
                'kelas' => collect(),
                'siswa' => null
            ]);
        }

        $kelas = $siswa->kelas()->with('guru')->get();

        return view('siswa.dashboard', compact('kelas', 'siswa'));
    }
}
