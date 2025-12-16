@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">Tambah Kelas</div>

    <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf

            <input class="form-control mb-2" name="kode_kelas" placeholder="Kode Kelas">
            <input class="form-control mb-2" name="nama_kelas" placeholder="Nama Kelas">

            <select name="hari" class="form-control mb-2">
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
            </select>

            <input type="time" name="jam_mulai" class="form-control mb-2">
            <input type="time" name="jam_selesai" class="form-control mb-2">

            <select name="guru_id" class="form-control mb-3">
                <option value="">-- Pilih Dosen --</option>
                @foreach($guru as $g)
                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
                @endforeach
            </select>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
