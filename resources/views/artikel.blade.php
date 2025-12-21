<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Artikel | MI Muhammadiyah Mulyosari</title>

  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
  body {
    background-size: cover;
    font-family: "Inter", "Segoe UI", sans-serif;
  }

  .overlay {
    background: rgba(255, 255, 255, .92);
    min-height: 100vh;
    padding: 120px 25px;
  }

  .title-page {
    font-size: 2.6rem;
    font-weight: 800;
    color: #1f3a4c;
    margin-bottom: 2.8rem;
    text-align: center;
    position: relative;
    display: inline-block;
  }

  /* Masonry Grid */
  .masonry {
    column-count: 3;
    column-gap: 1.8rem;
  }

  @media(max-width: 992px) {
    .masonry { column-count: 2; }
  }

  @media(max-width: 576px) {
    .masonry { column-count: 1; }
  }

  .masonry-item {
    break-inside: avoid;
    margin-bottom: 1.8rem;
  }

  /* Card */
  .artikel-card {
    border-radius: 16px;
    overflow: hidden;
    transition: .35s ease;
    background: #fff;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
  }

  .artikel-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 26px rgba(0,0,0,0.15);
  }

  /* Image */
  .artikel-img {
    width: 100%;
    height: auto;
    display: block;
    border-bottom: 1px solid #eee;
    transition: .35s;
  }

  .artikel-card:hover .artikel-img {
    transform: scale(1.03);
  }

  /* Card body */
  .card-body {
    padding: 26px 28px !important; 
}

.artikel-card h5 {
    font-size: 19px;
    line-height: 1.45;
    margin-bottom: 14px;
    font-weight: 700;
    color: #1e2a39;
}

.artikel-card p {
    line-height: 1.6;
    font-size: 14.2px;
    color: #606b75 !important;
    margin-bottom: 16px;
}

.artikel-card small {
    margin-bottom: 18px; 
    display: block;
    padding-left: 1px;
}


  /* Button */
  .btn-primary {
    border-radius: 10px;
    padding: 6px 12px;
    font-size: 13px;
  }
</style>

</head>
<body>

  {{-- Navbar --}}
  @include('partials.navbar')

  <div class="overlay">
    <div class="container text-center">
      <h1 class="title-page">Artikel</h1>

<div class="masonry">
  @forelse($artikels as $artikel)
  
  <div class="masonry-item">
    <div class="artikel-card">

      {{-- Gambar artikel --}}
      <img 
        src="{{ $artikel->gambar ? asset('storage/' . $artikel->gambar) : asset('img/default-article.jpg') }}"
        class="artikel-img"
        alt="{{ $artikel->judul }}"
      >

      <div class="card-body">
        <h5 class="fw-bold">{{ $artikel->judul }}</h5>

        <p class="text-muted" style="font-size: 14px;">
          {{ Str::limit(strip_tags($artikel->isi), 150) }}
        </p>

        <small class="d-block text-muted mb-3">
          <i class="bi bi-calendar-event"></i>
          {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}
        </small>

        <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-primary btn-sm px-3">
          Baca Selengkapnya →
        </a>
      </div>

    </div>
  </div>

  @empty
    <p class="text-center text-muted">Belum ada artikel, bestie 🥺</p>
  @endforelse
</div>


    </div>
  </div>

  {{-- Footer --}}
  <footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".custom-navbar");
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
