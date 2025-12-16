@extends('layouts.guru')

@section('title', 'Data Absensi')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Data Absensi Kelas Saya</h5>

         <!-- FILTER -->
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="date" name="tanggal" class="form-control"
                       value="{{ request('tanggal') }}">
            </div>

            <div class="col-md-4">
                <input type="text" name="kelas" class="form-control"
                       placeholder="Nama kelas"
                       value="{{ request('kelas') }}">
            </div>

            <div class="col-md-2">
                <button class="btn btn-soft-blue w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $a)
                <tr>
                    <td>{{ $a->tanggal }}</td>
                    <td>{{ $a->jam_absen }}</td>
                    <td>{{ $a->siswa->nama }}</td>
                    <td>{{ $a->kelas->nama_kelas }}</td>
                    <td>
                        <span class="badge bg-success">{{ $a->status }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada absensi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
