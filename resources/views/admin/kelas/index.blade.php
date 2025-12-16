@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Data Kelas</h5>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary">+ Tambah Kelas</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Guru</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->kode_kelas }}</td>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>{{ $k->hari }}</td>
                    <td>{{ $k->jam_mulai }} - {{ $k->jam_selesai }}</td>
                    <td>{{ $k->guru->nama ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $k->status_aktif ? 'bg-success' : 'bg-secondary' }}">
                            {{ $k->status_aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('kelas.peserta', $k) }}" class="btn btn-info btn-sm">Peserta</a>
                        <a href="{{ route('kelas.edit', $k) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kelas.destroy',$k->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kelas?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
