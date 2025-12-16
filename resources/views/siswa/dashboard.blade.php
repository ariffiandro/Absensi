@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')

<style>
.btn-absen {
    background-color: #65a1fc;
    color: #fff;
    border-radius: 10px;
    padding: 8px 18px;
    font-weight: 600;
    border: none;
}

.btn-absen:hover {
    background-color: #4c8df2;
    color: #fff;
}
</style>


@if($kelas->isEmpty())
    <div class="alert alert-warning">
        Kamu belum terdaftar di kelas manapun
    </div>
@else

<div class="row">
@foreach($kelas as $k)

@php
    $sudahAbsen = \App\Models\Absensi::where('siswa_id', $siswa->id)
        ->where('kelas_id', $k->id)
        ->whereDate('tanggal', now())
        ->exists();
@endphp

<div class="col-md-6 mb-4">
    <div class="card kelas-card">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <div class="kelas-title">{{ $k->nama_kelas }}</div>
                <div class="kelas-info">
                    {{ $k->hari }} |
                    {{ substr($k->jam_mulai,0,5) }} - {{ substr($k->jam_selesai,0,5) }}
                </div>
                <div class="kelas-info">
                    Dosen: {{ $k->guru->nama ?? '-' }}
                </div>
            </div>

            <div>
            @if($sudahAbsen)
                <!-- 🟢 SUDAH ABSEN -->
                <button class="btn btn-success" disabled>
                    <i class="bi bi-check-circle"></i> Sudah Absen
                </button>

            @elseif($k->isAktifSekarang())
                <!-- 🔵 BISA ABSEN -->
                <form action="{{ route('absen.store', $k->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-absen">
                        <i class="bi bi-camera-check"></i> Absen
                    </button>
                </form>

            @else
                <!-- ⚫ BELUM WAKTU -->
                <button class="btn btn-secondary" disabled>
                    <i class="bi bi-clock"></i> Belum Waktunya
                </button>
            @endif
            </div>

        </div>
    </div>
</div>

@endforeach
</div>
@endif
@endsection
