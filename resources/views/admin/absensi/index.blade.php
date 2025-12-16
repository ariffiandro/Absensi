@extends('layouts.admin')

@section('title', 'Data Absensi')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-4 fw-bold">📋 Data Absensi Siswa</h4>

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
            <div class="col-md-3">
                <a href="{{ route('admin.absensi.export.pdf') }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </a>
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Dosen</th>
                        <th>Tanggal</th>
                        <th>Jam Absen</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($absensi as $i => $a)
                    <tr>
                        <td>{{ $absensi->firstItem() + $i }}</td>
                        <td>{{ $a->siswa->nama ?? '-' }}</td>
                        <td>{{ $a->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $a->kelas->guru->nama ?? '-' }}</td>
                        <td>{{ $a->tanggal }}</td>
                        <td>{{ $a->jam_absen }}</td>
                        <td>
                            <span class="badge bg-success">
                                {{ $a->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada data absensi
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $absensi->links() }}

    </div>
</div>

@endsection
