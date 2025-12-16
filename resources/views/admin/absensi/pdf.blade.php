<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #ddd; }
    </style>
</head>
<body>

<h3>Data Absensi Siswa</h3>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Siswa</th>
            <th>Kelas</th>
            <th>Dosen</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absensi as $a)
        <tr>
            <td>{{ $a->tanggal }}</td>
            <td>{{ $a->jam_absen }}</td>
            <td>{{ $a->siswa->nama ?? '-' }}</td>
            <td>{{ $a->kelas->nama_kelas ?? '-' }}</td>
            <td>{{ $a->kelas->guru->nama ?? '-' }}</td>
            <td>{{ $a->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
