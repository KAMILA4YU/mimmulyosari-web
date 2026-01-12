<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard User')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        body {
            overflow-x: hidden;
        }

        /* SIDEBAR */
        #sidebar {
            width: 220px;
            background: #f8f9fa;
            border-right: 1px solid #dee2e6;
            min-height: 100vh;
            transition: 0.3s;
        }

        /* collapsed mode (desktop) */
        #sidebar.collapsed {
            width: 70px;
        }

        #sidebar.collapsed .nav-link span,
        #sidebar.collapsed h5 {
            display: none;
        }

        /* mobile mode: slide */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: -240px;
                z-index: 2000;
                height: 100vh;
            }
            #sidebar.active {
                left: 0;
            }
            #overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.4);
                z-index: 1500;
            }
        }

        /* MAIN CONTENT */
        #main-content {
            transition: margin-left 0.3s;
        }

        #sidebar.collapsed + #main-content {
            margin-left: 70px;
        }

        @media (max-width: 768px) {
            #main-content {
                margin-left: 0 !important;
            }
        }

        /* tombol logout */
        .logout-btn {
            border: 1px solid #dc3545;
            color: #dc3545 !important;
            border-radius: 8px;
            padding: 8px 12px;
            transition: 0.2s;
            background: transparent;
            text-align: left;

            max-width: 180px;       
            margin-left: auto;      
            margin-right: auto;     
        }

        /* hover */
        .logout-btn:hover {
            background: #dc3545;
            color: white !important;
        }

        #sidebar.collapsed .logout-btn span {
            display: none;
        }

        #sidebar.collapsed .logout-btn {
            padding-left: 14px;
            text-align: center;
        }

    </style>

</head>
<body>

<div id="overlay"></div>

<!-- Navbar -->
<nav class="navbar navbar-light bg-white border-bottom px-3">
    <button class="btn btn-outline-primary d-md-none" id="toggleMobile">
        ☰
    </button>

    <button class="btn btn-outline-secondary d-none d-md-inline" id="toggleDesktop">
        ☰
    </button>

    <span class="ms-3 fw-bold">PPDB Online MIM Mulyosari</span>
</nav>

<div class="d-flex">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar hidden border-end p-3">
        <h5 class="fw-bold mb-4">Dashboard</h5>

        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a href="{{ route('user.dashboard') }}" class="nav-link">
                    <i class="bi bi-house-door me-2"></i><span>Beranda</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('user.profil') }}" class="nav-link">
                    <i class="bi bi-person me-2"></i><span>Profil</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('ppdb.form') }}" class="nav-link">
                    <i class="bi bi-file-earmark-text me-2"></i><span>Daftar PPDB</span>
                </a>
            </li>

            <li class="nav-item mb-2 position-relative">
                <a href="{{ route('user.ppdb.hasil') }}"
                class="nav-link d-flex align-items-center justify-content-between">

                    <div>
                        <i class="bi bi-clipboard-check me-2"></i>
                        <span>Hasil PPDB</span>
                    </div>

                    @if(!empty($notifPesanUser) && $notifPesanUser > 0)
                        <span class="badge bg-danger rounded-pill">
                            {{ $notifPesanUser }}
                        </span>
                    @endif

                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('user.pengaduan.index') }}" class="nav-link">
                    <i class="bi bi-chat-dots me-2"></i><span>Pengaduan</span>
                </a>
            </li>

            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="nav-link logout-btn w-100">
                        <i class="bi bi-box-arrow-right me-2"></i><span>Logout</span>
                    </button>
                </form>
            </li>

        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main id="main-content" class="flex-grow-1 p-4">
        @yield('content')
    </main>

</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // mobile
    document.getElementById('toggleMobile').onclick = function () {
        sidebar.classList.toggle('active');
        overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
    };

    // klik luar sidebar tutup
    overlay.onclick = function () {
        sidebar.classList.remove('active');
        overlay.style.display = 'none';
    };

    // desktop collapse
    document.getElementById('toggleDesktop').onclick = function () {
        sidebar.classList.toggle('collapsed');
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
