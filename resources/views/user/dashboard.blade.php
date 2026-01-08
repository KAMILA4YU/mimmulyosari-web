@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')
<style>

    .dashboard-wrapper {
        padding-top: 10px;
        padding-bottom: 40px;
    }

    .dashboard-title {
        font-weight: 700;
        font-size: 2rem;
        color: #1f2d3d;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dashboard-title i {
        font-size: 1.9rem;
        color: #0d6efd;
    }

    .dashboard-subtitle {
        color: #6c757d;
        margin-top: 4px;
        font-size: 1rem;
    }

    .feature-card {
        border: none;
        border-radius: 18px;
        background: #ffffff;
        padding: 28px 20px;
        text-align: center;
        transition: .25s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 24px rgba(0,0,0,.12);
    }

    .feature-icon {
        font-size: 2.8rem;
        margin-bottom: 12px;
    }

    .feature-title {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 14px;
        color: #2d2d2d;
    }

    .feature-btn {
        padding: 8px 18px;
        font-size: .9rem;
        border-radius: 50px;
    }

    @media (max-width: 576px) {
        .dashboard-title {
            font-size: 1.6rem;
        }
        .dashboard-wrapper {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>

<div class="container dashboard-wrapper">

    <!-- header -->
    <div class="container mt-3">
    <h2 class="dashboard-title fw-bold mb-3">
        Halo, {{ Auth::user()->name }}
    </h2>
    <p class="dashboard-subtitle">
        Selamat datang di Portal PPDB Online MI Muhammadiyah Mulyosari.
    </p>
    </div>

    <!-- grid -->
    <div class="row g-2 mt-3">

        <!-- profil -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="feature-card">
                <i class="bi bi-person-circle feature-icon text-success"></i>
                <div class="feature-title">Profil Akun</div>
                <a href="{{ route('user.profil') }}" class="btn btn-outline-success feature-btn">
                    Lihat Profil
                </a>
            </div>
        </div>

        <!-- ppdb -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="feature-card">
                <i class="bi bi-file-earmark-text feature-icon text-primary"></i>
                <div class="feature-title">Daftar PPDB</div>
                <a href="{{ route('ppdb.form') }}" class="btn btn-outline-primary feature-btn">
                    Isi Formulir
                </a>
            </div>
        </div>

        <!-- hasil -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="feature-card">
                <i class="bi bi-clipboard-check feature-icon text-info"></i>
                <div class="feature-title">Hasil PPDB</div>
                <a href="{{ route('user.ppdb.hasil') }}" class="btn btn-outline-info feature-btn">
                    Lihat Hasil
                </a>
            </div>
        </div>

        <!-- pengaduan -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="feature-card">
                <i class="bi bi-chat-dots feature-icon text-danger"></i>
                <div class="feature-title">Pengaduan</div>
                <a href="{{ route('user.pengaduan.index') }}" class="btn btn-outline-danger feature-btn">
                    Kelola Pengaduan
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
