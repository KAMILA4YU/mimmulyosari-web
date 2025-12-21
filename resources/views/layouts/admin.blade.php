<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Admin - {{ config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f9fc;
            font-family: "Segoe UI", sans-serif;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background-color: #3a6ea5 !important;
        }

        /* ===== SIDEBAR ===== */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background-color: #3a6ea5;
            color: #fff;
            position: fixed;
            top: 56px; /* tinggi navbar */
            bottom: 0;
            left: 0;
            overflow-y: auto;
            transition: all 0.3s;
            padding: 1rem;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed h5 {
            display: none;
        }

        .sidebar .nav-link {
            color: #e9eff6;
            font-size: 15px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar .nav-link:hover {
            background-color: #2f5b87;
            color: #ffffff;
        }

        .sidebar h5 {
            color: #ffffff;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex-grow: 1;
            margin-left: 250px;
            padding: 20px;
            margin-top: 56px; /* offset dari navbar */
            background-color: #ffffff;
            border-radius: 12px 0 0 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            min-height: calc(100vh - 56px);
            overflow-y: auto;
            transition: margin-left 0.3s;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Saat sidebar collapse */
        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .sidebar {
                left: -250px;
                top: 56px;
                z-index: 1050;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }

        /* ===== BUTTON LOGOUT ===== */
        .btn-logout {
            background-color: #c0392b;
            border: none;
        }

        .btn-logout:hover {
            background-color: #a93226;
        }

        .sidebar .badge {
    font-size: 11px;
    padding: 4px 7px;
}

.badge-danger-soft {
    background-color: #DE4545;
    color: #fff;
}

    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Navbar atas --}}
    <nav class="navbar navbar-dark navbar-custom px-3 shadow-sm fixed-top">
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-light me-3 d-lg-none" id="toggleSidebarBtn">☰</button>
            <span class="text-white fw-bold fs-5 me-3 d-none d-lg-inline toggle-btn" onclick="toggleSidebar()">☰</span>
            <a class="navbar-brand fw-bold text-white" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        </div>
        <div>
            <a href="{{ route('admin.profil') }}" class="nav-link d-inline text-white me-3">Profil</a>
        </div>
    </nav>

    <div class="admin-wrapper">
        {{-- Sidebar --}}
        <aside id="sidebar" class="sidebar">
            <h5 class="fw-bold mb-4">MI Muhammadiyah<br>Mulyosari</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span>Dashboard</span></a></li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.ppdb.pendaftar') }}"
                    class="nav-link d-flex justify-content-between align-items-center">
                        <span>Data Pendaftar PPDB</span>

                        @if($notifPpdb > 0)
                            <span class="badge badge-danger-soft rounded-pill">
                                {{ $notifPpdb == 10 ? '10+' : $notifPpdb}}
                            </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-2"><a href="{{ route('admin.ppdb.berkas') }}" class="nav-link"><span>Berkas Pendaftar</span></a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.siswa.index', ['tab' => 'guru']) }}" class="nav-link"><span>Data Guru & Siswa</span></a></li>

                <hr class="border-light">
                <li class="nav-item mb-2"><a href="{{ route('admin.home-section.edit') }}" class="nav-link"><span>Beranda Sekolah</span></a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.profil-sekolah') }}" class="nav-link"><span>Profil Sekolah</span></a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.kesiswaan.index', ['tab' => 'ekskul']) }}" class="nav-link"><span>Kesiswaan</span></a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.informasi') }}" class="nav-link"><span>Informasi</span></a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.berita') }}" class="nav-link"><span>Berita</span></a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.artikel') }}" class="nav-link"><span>Artikel</span></a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.galeri') }}" class="nav-link"><span>Galeri</span></a></li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.kontak.index', ['tab' => 'pesan']) }}"
                    class="nav-link d-flex justify-content-between align-items-center">
                        <span>Kontak</span>

                        @if($notifKontak > 0)
                            <span class="badge badge-danger-soft rounded-pill">
                                {{ $notifKontak == 10 ? '10+' : $notifKontak }}
                            </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.pengaduan.index') }}"
                    class="nav-link d-flex justify-content-between align-items-center">
                        <span>Pengaduan</span>

                        @if($notifPengaduan > 0)
                            <span class="badge badge-danger-soft rounded-pill">
                                {{ $notifPengaduan == 10 ? '10+' : $notifPengaduan }}
                            </span>
                        @endif
                    </a>
                </li>

                <hr class="border-light">
                <li class="nav-item mt-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-logout text-white w-100">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>

        {{-- Konten utama --}}
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
        }

        // versi mobile
        toggleSidebarBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>

@stack('scripts')
@stack('styles')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
