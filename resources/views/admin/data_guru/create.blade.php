@extends('layouts.admin')
@section('title', 'Tambah Wali Kelas')

@section('content')

<style>
    .form-container {
        background-color: #e6f0ff; /* soft blue seperti index */
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        max-width: 600px;
        margin: auto;
    }

    .form-container h3 {
        font-weight: 700;
        color: #1a237e;
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        font-weight: 600;
        color: #1a237e;
    }

    .form-control {
        border: 2px solid #b3d1ff;
        border-radius: 8px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 5px rgba(74,144,226,0.4);
    }

    .btn-blue {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-blue:hover {
        background-color: #3571c1;
        color: #fff;
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }
</style>

<div class="guru-container">
    <h4>Tambah Wali Kelas</h4>

    <form action="{{ route('data_guru.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Wali</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button class="btn-blue" type="submit">Simpan</button>
        <a href="{{ route('data_guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection
