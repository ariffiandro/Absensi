<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Absensi::with(['siswa','kelas.guru'])->get()->map(function ($a) {
            return [
                'Tanggal' => $a->tanggal,
                'Jam Absen' => $a->jam_absen,
                'Nama Siswa' => $a->siswa->nama ?? '-',
                'Kelas' => $a->kelas->nama_kelas ?? '-',
                'Dosen' => $a->kelas->guru->nama ?? '-',
                'Status' => $a->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Jam Absen',
            'Nama Siswa',
            'Kelas',
            'Dosen',
            'Status',
        ];
    }
}
