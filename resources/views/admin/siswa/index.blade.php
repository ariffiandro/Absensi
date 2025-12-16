@extends('layouts.admin') 

@section('title', 'Data Siswa')

@section('content')

<style>
    .siswa-container {
        background-color: #e6f0ff; /* soft blue background */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 1000px; /* agar table lebih luas */
    }

    .btn-blue {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-blue:hover {
        background-color: #3571c1;
        color: #fff;
    }

    table th {
        background-color: #90caf9 !important; /* soft blue header */
        color: #1a237e; /* dark blue text */
        text-align: center;
        padding: 10px 8px;
    }

    table td {
        text-align: center;
        vertical-align: middle;
        padding: 8px 6px;
    }

    tbody tr:hover {
        background-color: #d0e4ff; /* hover soft blue */
    }

    .btn-icon {
        border: none;
        padding: 5px 7px;
        border-radius: 4px;
        cursor: pointer;
        transition: .2s;
        margin: 0 2px;
        font-size: 12px;
    }

    .btn-edit-icon {
        background-color: #2196f3; /* biru edit button */
        color: #fff;
    }

    .btn-edit-icon:hover {
        background-color: #1976d2;
        transform: scale(1.15);
    }

    .btn-delete-icon {
        background-color: #f44336; /* merah delete */
        color: white;
    }

    .btn-delete-icon:hover {
        background-color: #d32f2f;
        transform: scale(1.15);
    }

    .submenu {
    margin-left: 25px;
    display: none;
    position: relative; /* atau absolute jika ingin overlay */
    z-index: 1000; /* pastikan muncul di atas content */
    background-color: #65a1fc; /* sama dengan sidebar */
    border-radius: 6px;
    padding: 5px 0;
    }

    .submenu a {
        display: block;
        padding: 8px 10px;
        font-size: 16px;
        color: #ffffff;
    }

    .submenu a:hover {
        background: #8cbaff;
        color: #fff;
    }
</style>

<div class="siswa-container">

    <a href="{{ route('siswa.create') }}" class="btn btn-blue mb-3">+ Tambah Siswa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->nis }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->alamat }}</td>
                <td>{{ $row->tanggal_lahir }}</td>
                <td>
                    <a href="{{ route('siswa.edit', $row->id) }}" class="btn-icon btn-edit-icon" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button"
                        class="btn-icon btn-delete-icon"
                        onclick="confirmDelete('{{ $row->id }}')"
                        title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>

                    <form id="delete-form-{{ $row->id }}" action="{{ route('siswa.destroy', $row->id) }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- SweetAlert2 & FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data siswa yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
    @endif
</script>

@endsection
