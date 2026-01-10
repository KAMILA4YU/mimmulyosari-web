<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $artikel->judul }} | MI Muhammadiyah Mulyosari</title>

  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-size: cover;
      font-family: "Inter", "Segoe UI", Tahoma, sans-serif;
    }

    /* Overlay putih */
    .overlay {
      background: rgba(255, 255, 255, 0.92);
      min-height: 100vh;
      padding: 120px 40px 80px;
    }

    /* Card utama */
    .detail-card {
      border-radius: 18px;
      background: #fff;
      padding: 42px;
      box-shadow: 0 10px 32px rgba(0,0,0,0.12);
      max-width: 1200px;
      margin: 30px auto 0;
    }
    

    /* Judul */
    .judul-artikel {
      color: #1f3a4c;
      font-weight: 800;
      font-size: 36px;
      line-height: 1.35;
      margin-bottom: 18px;
    }

    /* Info artikel */
    .sub-info {
      color: #67727e;
      font-size: 15.5px;
      margin-bottom: 22px;
    }

    /* Gambar */
    .detail-img {
      width: 100%;
      max-height: 450px;
      object-fit: cover;
      border-radius: 14px;
      box-shadow: 0 5px 16px rgba(0,0,0,0.12);
      transition: .3s ease;
    }

    .detail-img:hover {
      transform: scale(1.015);
    }

    /* Isi teks */
    .content {
      margin-top: 30px;
      font-size: 17px;
      line-height: 1.75;
      color: #2f2f2f;
    }

    .content img {
      max-width: 100%;
      border-radius: 10px;
      margin: 20px 0;
    }

    .content p {
      margin-bottom: 18px;
    }

    /* Tombol kembali */
    .btn-back {
      border-radius: 30px;
      padding: 8px 18px;
      font-size: 15px;
    }

    /* RESPONSIVE */
    @media(max-width: 1200px) {
      .overlay {
        padding: 110px 25px 60px;
      }
      .detail-card {
        padding: 30px;
      }
    }

    @media(max-width: 576px) {
      .overlay {
        padding: 100px 15px 40px;
      }

      .detail-card {
        padding: 22px;
        border-radius: 14px;
      }

      .judul-artikel {
        font-size: 26px;
        line-height: 1.35;
      }

      .content {
        font-size: 15.8px;
      }

      .detail-img {
        max-height: 280px;
        border-radius: 10px;
      }
    }
  </style>

</head>
<body>

  <!-- navbar -->
  @include('partials.navbar')

  <div class="overlay">
    <div class="container-xl">


      <!-- tombol kembali -->
      <div class="mb-4">
        <a href="{{ route('artikel') }}" class="btn btn-outline-primary btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Artikel
        </a>

      </div>

      <div class="detail-card">
        <h1 class="judul-artikel mb-3">{{ $artikel->judul }}</h1>

        <div class="sub-info mb-4">
          @if($artikel->penulis)
          <i class="bi bi-person"></i> {{ $artikel->penulis }} &nbsp;•&nbsp;
          @endif

          <i class="bi bi-calendar-event"></i>
          {{ \Carbon\Carbon::parse($artikel->tanggal ?? $artikel->created_at)->translatedFormat('d F Y') }}
        </div>

        @if($artikel->gambar)
        <img src="{{ asset('storage/' . $artikel->gambar) }}" class="detail-img mb-4">
        @endif

        <div class="content">
          {!! nl2br($artikel->isi) !!}
        </div>

      </div>

    </div>
  </div>

  <footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>


  <!-- NAVBAR -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".custom-navbar");

    // Di halaman artikel + artikel detail navbar harus SOLID
    if (window.location.pathname.includes("artikel")) {
      navbar.classList.add("navbar-solid");
      navbar.classList.remove("navbar-transparent");
    } else {
      function updateNavbar() {
        if (window.scrollY > 50) {
          navbar.classList.add("navbar-solid");
          navbar.classList.remove("navbar-transparent");
        } else {
          navbar.classList.remove("navbar-solid");
          navbar.classList.add("navbar-transparent");
        }
      }
      updateNavbar();
      window.addEventListener("scroll", updateNavbar);
    }
  });
  </script>

</body>
</html>
