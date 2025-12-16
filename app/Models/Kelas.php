<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\DataGuru;
use App\Models\Absensi;
use Carbon\Carbon;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'guru_id',
        'status_aktif',
    ];

    // RELASI GURU
    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'guru_id');
    }

    // RELASI SISWA (MANY TO MANY)
    public function siswa()
    {
        return $this->belongsToMany(
            Siswa::class,
            'kelas_siswa',
            'kelas_id',
            'siswa_id'
        );
    }

    // RELASI ABSENSI
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    // 🔥 CEK APAKAH KELAS AKTIF SESUAI HARI & JAM

    public function isAktifSekarang()
    {
        $now = Carbon::now('Asia/Jakarta');

        $hariSekarang = ucfirst($now->locale('id')->isoFormat('dddd'));
        $jamSekarang  = $now->format('H:i');

        $jamMulai   = substr($this->jam_mulai, 0, 5);
        $jamSelesai = substr($this->jam_selesai, 0, 5);

        // 1️⃣ KELAS NORMAL (tidak lewat tengah malam)
        if ($jamMulai <= $jamSelesai) {
            return $this->hari === $hariSekarang
                && $jamSekarang >= $jamMulai
                && $jamSekarang <= $jamSelesai;
        }

        // 2️⃣ KELAS MALAM (lewat tengah malam)
        return (
            // Hari mulai, jam >= jam_mulai
            ($this->hari === $hariSekarang && $jamSekarang >= $jamMulai)
            ||
            // Hari berikutnya, jam <= jam_selesai
            ($hariSekarang === Carbon::parse($this->hari)->addDay()->locale('id')->isoFormat('dddd')
                && $jamSekarang <= $jamSelesai)
        );
    }
}
