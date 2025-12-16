@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')

<style>
    body {
        background-color: #ffffffff;
        font-family: Arial, sans-serif;
    }

    .header-bar {
        background: #65a1fc;
        color: white;
        margin-left: -30px;
        margin-right: -15px;
    }

    /* SUMMARY CARD (update warna teks + hover) */
    .summary-card {
        padding: 40px;
        border-radius: 14px;
        background: #65a1fc;
        border: 1px solid #dcdcdc;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;           
        transition: 0.3s ease;     
        cursor: pointer;
    }

    .summary-card:hover {
        background: #8cbaff;
        color: #ffffff;        
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .chart-container {
        background: #ffffff;
        border-radius: 30px;
        border: 1px solid #ddd;
        padding: 30px;
        margin-top: 20px;
    }

    .btn-soft-blue {
        background: #65a1fc;
        color: white;
        border: none;
    }

    .btn-soft-blue:hover {
        background: #4c8df2;
        color: white;
    }
</style>


<div class="header-wrapper">
    <div class="header-bar d-flex justify-content-between align-items-center">
        <h5 class="m-0">Admin Dashboard</h5>
        <span>👤 Admin</span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-3"><div class="summary-card">Total Siswa</div></div>
    <div class="col-3"><div class="summary-card">Total Guru</div></div>
    <div class="col-3"><div class="summary-card">Total Kelas</div></div>
    <div class="col-3"><div class="summary-card">Total Absen</div></div>
</div>

<div class="chart-container">
    <h5 class="mb-3">Grafik Aktivitas Pengguna</h5>
    <canvas id="activityChart"></canvas>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('activityChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            datasets: [{
                label: 'Jumlah Pengguna Aktif',
                data: [45, 60, 55, 70, 90, 85],
                borderWidth: 3,
                borderColor: '#4e8cff',
                backgroundColor: 'rgba(78, 140, 255, 0.3)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
