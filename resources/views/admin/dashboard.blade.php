@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <h4 class="mb-4 fw-bold text-primary">Dashboard Admin</h4>

    <!-- statistik -->
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card stats-card shadow-sm border-0 p-3">
                <h6 class="text-muted small">Total Siswa</h6>
                <h2 class="fw-bold">{{ $totalSiswa }}</h2>
                <a href="{{ route('admin.guru-siswa', ['tab' => 'siswa']) }}"
                class="text-primary small fw-semibold">Lihat Data →</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stats-card shadow-sm border-0 p-3">
                <h6 class="text-muted small">PPDB Aktif</h6>
                <h2 class="fw-bold">{{ $ppdbAktif }}</h2>
                <a href="{{ route('admin.ppdb.pendaftar') }}"
                class="text-success small fw-semibold">Lihat PPDB →</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stats-card shadow-sm border-0 p-3">
                <h6 class="text-muted small">Berita</h6>
                <h2 class="fw-bold">{{ $totalBerita }}</h2>
                <a href="{{ route('admin.berita') }}"
                class="text-warning small fw-semibold">Lihat Berita →</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stats-card shadow-sm border-0 p-3">
                <h6 class="text-muted small">Pengaduan</h6>
                <h2 class="fw-bold">{{ $pengaduanPending }}</h2>
                <a href="{{ route('admin.pengaduan.index') }}"
                class="text-danger small fw-semibold">Lihat Pengaduan →</a>
            </div>
        </div>

    </div>

    <!-- chart session -->
    <div class="mt-5">
        <h5 class="fw-bold text-secondary mb-3">Statistik Sistem</h5>

        <div class="card shadow-sm border-0 p-4">
            <canvas id="chartDashboard" height="90"></canvas>
        </div>
    </div>

</div>
@endsection


<!-- chart script -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const totalSiswa        = {{ $totalSiswa }};
    const ppdbAktif         = {{ $ppdbAktif }};
    const totalBerita       = {{ $totalBerita }};
    const pengaduanPending  = {{ $pengaduanPending }};

    const ctx = document.getElementById('chartDashboard').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Siswa', 'PPDB', 'Berita', 'Pengaduan'],
            datasets: [{
                label: 'Jumlah Data',
                data: [
                    totalSiswa,
                    ppdbAktif,
                    totalBerita,
                    pengaduanPending
                ],
                borderWidth: 2,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.4)',
                    'rgba(75, 192, 192, 0.4)',
                    'rgba(255, 206, 86, 0.4)',
                    'rgba(255, 99, 132, 0.4)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ]
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


@push('styles')
<style>
    .stats-card {
        transition: 0.3s;
        border-radius: 16px;
        background: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .stats-card h2 {
        font-size: 2rem;
    }
</style>
@endpush
