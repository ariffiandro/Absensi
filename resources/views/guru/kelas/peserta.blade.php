@extends('layouts.guru')

@section('title','Peserta Kelas')

@section('content')
<div class="card">
    <div class="card-body">
        <h5>Peserta - {{ $kelas->nama_kelas }}</h5>

        <form method="POST">
            @csrf
            <div class="row">
                @foreach($siswa as $s)
                <div class="col-md-4">
                    <label>
                        <input type="checkbox" name="siswa_id[]"
                               value="{{ $s->id }}"
                               {{ in_array($s->id,$peserta) ? 'checked':'' }}>
                        {{ $s->nama }}
                    </label>
                </div>
                @endforeach
            </div>

            <button class="btn btn-soft-blue mt-3">Simpan Peserta</button>
        </form>
    </div>
</div>
@endsection
