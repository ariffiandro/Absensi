@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Peserta Kelas: <strong>{{ $kelas->nama_kelas }}</strong>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('kelas.peserta.store',$kelas->id) }}">
            @csrf
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr>
                        <td>
                            <input type="checkbox" name="siswa_id[]"
                                value="{{ $s->id }}"
                                {{ in_array($s->id,$peserta) ? 'checked' : '' }}>
                        </td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-primary">Simpan Peserta</button>
        </form>
    </div>
</div>
@endsection
