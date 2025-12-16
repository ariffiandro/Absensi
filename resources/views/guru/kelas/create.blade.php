@extends('layouts.guru')

@section('title','Tambah Kelas')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Kelas</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('guru.kelas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kode Kelas</label>
                <input type="text" name="kode_kelas"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Nama Kelas</label>
                <input type="text" name="nama_kelas"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Hari</label>
                <select name="hari" class="form-control" required>
                    <option value="">-- Pilih Hari --</option>
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                    <option>Sabtu</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai"
                           class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai"
                           class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('guru.kelas.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-soft-blue">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
