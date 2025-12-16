@extends('layouts.admin')
@section('title', 'Edit Wali Kelas')

@section('content')

<style>
    .edit-container {
        background-color: #e6f0ff; /* soft blue background */
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        max-width: 1000px;
    }

    .edit-container h3 {
        margin-bottom: 20px;
        color: #1a237e;
        font-weight: 600;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #90caf9;
        padding: 10px;
        margin-bottom: 15px;
    }

    .form-control:focus {
        box-shadow: 0 0 5px rgba(66, 165, 245, 0.5);
        border-color: #4a90e2;
    }

    .btn-blue {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-blue:hover {
        background-color: #3571c1;
        color: #fff;
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: .2s;
    }
</style>

<div class="guru-container">
    <h4>Edit Wali Kelas</h4>

    <form action="{{ route('data_guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Wali</label>
            <input type="text" name="nama" value="{{ $guru->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" value="{{ $guru->kelas }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $guru->email }}" class="form-control" required>
        </div>

        <button class="btn-blue" type="submit">Update</button>
        <a href="{{ route('data_guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection
