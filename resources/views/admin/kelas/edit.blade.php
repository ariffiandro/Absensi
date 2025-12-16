@extends('layouts.admin')

@section('title', 'Edit Kelas')

@section('content')

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Kelas</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kode Kelas -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Kelas</label>
                        <input type="text"
                               name="kode_kelas"
                               class="form-control"
                               value="{{ $kelas->kode_kelas }}"
                               required>
                    </div>

                    <!-- Nama Kelas -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Kelas</label>
                        <input type="text"
                               name="nama_kelas"
                               class="form-control"
                               value="{{ $kelas->nama_kelas }}"
                               required>
                    </div>
                </div>

                <div class="row">
                    <!-- Hari -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hari</label>
                        <select name="hari" class="form-control" required>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                                <option value="{{ $h }}" {{ $kelas->hari == $h ? 'selected' : '' }}>
                                    {{ $h }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time"
                               name="jam_mulai"
                               class="form-control"
                               value="{{ substr($kelas->jam_mulai,0,5) }}"
                               required>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time"
                               name="jam_selesai"
                               class="form-control"
                               value="{{ substr($kelas->jam_selesai,0,5) }}"
                               required>
                    </div>
                </div>

                <!-- Guru -->
                <div class="mb-3">
                    <label class="form-label">Guru</label>
                    <select name="guru_id" class="form-control">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}" {{ $kelas->guru_id == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <input type="hidden" name="status_aktif" value="0">
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="status_aktif"
                               value="1"
                               id="statusAktif"
                               {{ $kelas->status_aktif ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusAktif">
                            Aktifkan Kelas
                        </label>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>

                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
