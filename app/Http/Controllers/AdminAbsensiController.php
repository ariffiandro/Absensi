<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

class AdminAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with(['siswa', 'kelas.guru'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_absen', 'desc');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $absensi = $query->paginate(10);

        return view('admin.absensi.index', compact('absensi'));
    }

    // 🧾 EXPORT PDF
    public function exportPdf()
    {
        $absensi = Absensi::with(['siswa', 'kelas.guru'])->get();

        $pdf = Pdf::loadView('admin.absensi.pdf', compact('absensi'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('data-absensi.pdf');
    }

    // 📊 EXPORT EXCEL
    public function exportExcel()
    {
        return Excel::download(new AbsensiExport, 'data-absensi.xlsx');
    }
}
