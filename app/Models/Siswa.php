<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Absensi;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama', 'nis', 'email', 'alamat', 'tanggal_lahir'
    ];


    public function kelas()
    {
        return $this->belongsToMany(
            Kelas::class,
            'kelas_siswa',
            'siswa_id',
            'kelas_id'
        );
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}

