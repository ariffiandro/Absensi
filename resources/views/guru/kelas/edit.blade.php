@extends('layouts.guru')

@section('title','Edit Kelas')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Kelas</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('guru.kelas.update',$kelas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kode Kelas</label>
                <input type="text" name="kode_kelas"
                       class="form-control"
                       value="{{ $kelas->kode_kelas }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Nama Kelas</label>
                <input type="text" name="nama_kelas"
                       class="form-control"
                       value="{{ $kelas->nama_kelas }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Hari</label>
                <select name="hari" class="form-control" required>
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                        <option value="{{ $h }}"
                            {{ $kelas->hari == $h ? 'selected':'' }}>
                            {{ $h }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai"
                           class="form-control"
                           value="{{ substr($kelas->jam_mulai,0,5) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai"
                           class="form-control"
                           value="{{ substr($kelas->jam_selesai,0,5) }}"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status_aktif" class="form-control">
                    <option value="1" {{ $kelas->status_aktif ? 'selected':'' }}>Aktif</option>
                    <option value="0" {{ !$kelas->status_aktif ? 'selected':'' }}>Nonaktif</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('guru.kelas.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-soft-blue">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
