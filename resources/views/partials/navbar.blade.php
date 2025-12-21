<link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

<style>
.custom-navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1030;
  transition: all 0.3s ease;
}

.navbar-transparent {
  background-color: transparent;
  backdrop-filter: none;
}

.navbar-solid {
  background-color: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(12px);
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}



  .custom-navbar .nav-link {
    font-weight: 500;
    color: black;
  }

  .custom-navbar .nav-link:hover {
    color: #198754;
  }

  .btn-register {
    background-color: #198754;
    color: white;
    border-radius: 30px;
    padding: 6px 20px;
    font-weight: 500;
    text-transform: lowercase;
  }

  .btn-register:hover {
    background-color: #157347;
  }

  /* Saat menu terbuka (mobile) */
  .navbar-collapse.show {
    background-color: white;
    padding: 10px 0;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }

  /* Warna ikon toggle (opsional override) */
  .navbar-toggler {
    border: none;
  }

  .navbar-toggler-icon {
    filter: brightness(0.5);
  }
  
  /* Responsive navbar fix */
  @media (max-width: 991.98px) {
    .custom-navbar {
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(8px);
    }

    .nav-link {
      color: black !important;
    }

    .btn-register {
      margin-top: 10px;
      display: inline-block;
    }
  }
</style>

<nav class="navbar navbar-expand-lg custom-navbar navbar-transparent">
  <div class="container">

    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" height="50">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav mx-lg-auto gap-2 px-3">

        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('profil.sekolah') }}">Profil</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('kesiswaan') }}">Kesiswaan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('informasi') }}">Informasi</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('berita') }}">Berita</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('artikel') }}">Artikel</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('galeri') }}">Galeri</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('kontak.index') }}">Kontak</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('ppdb.index') }}">PPDB Online</a></li>

        <!-- MOBILE AUTH BUTTON -->
        <li class="nav-item d-lg-none mt-3">
          @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-danger w-100 rounded-pill">
                Logout
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-success w-100 rounded-pill mb-2">
              Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-register w-100 rounded-pill">
              Registrasi
            </a>
          @endif
        </li>

      </ul>
    </div>

    <!-- DESKTOP AUTH BUTTON -->
    <div class="d-none d-lg-flex gap-2">
      @if(Auth::check())
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger rounded-pill px-4">
            Logout
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn btn-outline-success rounded-pill px-4">
          Login
        </a>
        <a href="{{ route('register') }}" class="btn btn-register rounded-pill px-4">
          Registrasi
        </a>
      @endif
    </div>

  </div>
</nav>

