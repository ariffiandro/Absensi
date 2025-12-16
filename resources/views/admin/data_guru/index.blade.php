@extends('layouts.admin')
@section('title', 'Data Guru')

@section('content')

<style>
    .guru-container {
        background-color: #e6f0ff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        max-width: 1000px;
        margin-top: 5px; /* 🔧 FIX: jarak dari header */
    }

    .btn-blue {
        background-color: #4a90e2;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-blue:hover {
        background-color: #3571c1;
        color: #fff;
    }

    table th {
        background-color: #90caf9 !important;
        color: #1a237e;
        text-align: center;
    }

    table td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-edit {
        background:#2196f3;
        color:white;
        padding:5px 10px;
        border-radius:5px;
        text-decoration: none;
    }

    .btn-delete {
        background:#f44336;
        color:white;
        padding:5px 10px;
        border-radius:5px;
        border:none;
    }
</style>

<div class="guru-container">

    {{-- 🔧 FIX: tombol diberi wrapper agar ada jarak --}}
    <div class="mb-4">
        <a href="{{ route('data_guru.create') }}" class="btn-blue">
            + Tambah Data Guru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Wali</th>
                <th>Kelas</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($guru as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->kelas }}</td>
                <td>{{ $row->email }}</td>
                <td>
                    <a href="{{ route('data_guru.edit', $row->id) }}" class="btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('data_guru.destroy', $row->id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button type="submit"
                                class="btn-delete"
                                onclick="return confirm('Hapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
