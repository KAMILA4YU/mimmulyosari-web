<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')
  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Berita | MI Muhammadiyah Mulyosari</title>

  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .overlay {
      background: rgba(255, 255, 255, 0.92);
      padding: 120px 20px 70px;
      min-height: 100vh;
    }

    /* ===== TITLE ===== */
    .title-page {
      font-size: 2.6rem;
      font-weight: 800;
      color: #1f3a4c;
      margin-bottom: 2.8rem;
      text-align: center;
      position: relative;
      display: inline-block;
    }

    .title-page::after {
      content: "";
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      border-radius: 8px;
      background: #1f3a4c;
      opacity: 0.85;
    }

    /* ===== CARD BERITA ===== */
    .card-berita {
      border-radius: 20px;
      overflow: hidden;
      border: none;
      background: #fff;
      display: flex;
      flex-direction: column;
      height: 100%;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
      transition: 0.3s ease;
    }

    .card-berita:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }

    /* Gambar lebih konsisten dan aesthetic */
    .card-berita img {
      width: 100%;
      height: 210px;
      object-fit: cover;
    }

    /* Body card */
    .card-body {
      padding: 20px 22px !important;
      display: flex;
      flex-direction: column;
    }

    /* TITLE BERITA */
    .card-title {
      font-weight: 700;
      font-size: 1.15rem;
      line-height: 1.35;
      color: #1f3a4c;
      margin-bottom: 10px;
    }

    /* ISI PREVIEW */
    .card-text {
      font-size: 0.95rem;
      line-height: 1.5;
      color: #555;
      margin-bottom: 18px;
    }

    /* Tombol */
    .btn-read {
      padding: 7px 16px;
      font-size: 0.9rem;
      border-radius: 10px;
      font-weight: 600;
      margin-top: auto;
    }

    /* ===== SPACING GRID ===== */
    .row.g-4 {
      row-gap: 32px;
    }

    /* MOBILE FIX SUPER RAPI */
    @media (max-width: 576px) {
      .title-page {
        font-size: 1.8rem;
      }

      .card-berita img {
        height: 180px;
      }

      .card-body {
        padding: 16px !important;
      }

      .card-title {
        font-size: 1.05rem;
      }

      .card-text {
        font-size: 0.92rem;
      }
    }

  </style>
</head>
<body>

  @include('partials.navbar')

  <div class="overlay">
    <div class="container text-center">
      <h1 class="title-page">Berita Sekolah</h1>
    </div>

    <div class="container mt-4">

      <div class="row g-4 mb-5">

        @forelse ($berita as $item)
        <div class="col-md-6 col-lg-4">
          <div class="card-berita">

            <!-- Gambar -->
            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">

            <!-- Body -->
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $item->judul }}</h5>

              <p class="card-text">
                {{ Str::limit(strip_tags($item->isi), 130) }}
              </p>

              <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-primary btn-read mt-auto">
                Baca Selengkapnya
              </a>
            </div>

          </div>
        </div>
        @empty
          <p class="text-muted text-center">Belum ada berita.</p>
        @endforelse

      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        {{ $berita->links() }}
      </div>

    </div>
  </div>

   <!-- FOOTER -->
  <footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".custom-navbar");
    navbar?.classList.add("navbar-solid");
  });
  </script>

</body>
</html>

