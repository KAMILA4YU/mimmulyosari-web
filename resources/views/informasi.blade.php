<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Informasi | MI Muhammadiyah Mulyosari</title>

  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .overlay {
      background-color: rgba(255, 255, 255, 0.9);
      min-height: 100vh;
      padding: 120px 50px 80px;
    }

    @media (max-width: 576px) {
      .overlay {
        padding: 120px 20px 60px;
      }
    }

    .page-title {
      font-size: 2.6rem;
      font-weight: 800;
      color: #1f3a4c;
      margin-bottom: 2.8rem;
      text-align: center;
    }

    @media (max-width: 576px) {
      .page-title {
        font-size: 1.9rem;
        margin-bottom: 2rem;
      }
    }

    .section-title {
      color: #1f3a4c;
      font-weight: 700;
      margin-bottom: 25px;
      border-left: 6px solid #1f3a4c;
      padding-left: 12px;
    }

    .card {
      border-radius: 14px;
      overflow: hidden;
      border: none;
      transition: 0.3s;
      box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }

    .list-group-item {
      border-radius: 10px;
      margin-bottom: 10px;
      background: #fdfdfd;
      border: 1px solid #eee;
      transition: 0.2s;
    }

    .list-group-item:hover {
      background: #f1f7ff;
    }

    table td {
      padding: 14px 18px;
    }
  </style>
</head>
<body>

  {{-- NAVBAR --}}
  @include('partials.navbar')

  {{-- OVERLAY WRAPPER --}}
  <div class="overlay">
    <div class="container">

      <h1 class="page-title">Informasi Sekolah</h1>

      {{-- ===================== PENGUMUMAN ===================== --}}
      <h3 class="section-title">Pengumuman</h3>
      <div class="list-group mb-5">
        @forelse($pengumuman as $item)
          <div class="list-group-item d-flex flex-column flex-sm-row align-items-start align-items-sm-center">
            <div class="d-flex align-items-center flex-grow-1">
              <i class="bi bi-megaphone-fill text-primary me-2"></i>
              <strong>{{ $item->judul }}</strong>
            </div>
            <small class="text-muted mt-1 mt-sm-0 ms-sm-auto">
              {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
            </small>
          </div>
        @empty
          <p class="text-muted">Belum ada pengumuman.</p>
        @endforelse
      </div>

      {{-- ===================== BERITA ===================== --}}
      <h3 class="section-title">Berita Terbaru</h3>
      <div class="row g-4 mb-5">
        @forelse($berita as $item)
          <div class="col-md-6 col-lg-4">
            <div class="card h-100">

              @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
              @else
                <img src="{{ asset('img/no-image.png') }}" class="card-img-top" style="height: 200px; object-fit: cover;">
              @endif

              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-semibold">{{ $item->judul }}</h5>
                <p class="card-text text-muted">
                  {{ Str::limit(strip_tags($item->isi), 120) }}
                </p>

                <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-primary btn-sm mt-auto w-100">
                  Baca Selengkapnya
                </a>
              </div>
            </div>
          </div>
        @empty
          <p class="text-muted">Belum ada berita.</p>
        @endforelse
      </div>


      {{-- ===================== AGENDA ===================== --}}
      <h3 class="section-title">Agenda Kegiatan</h3>
      <div class="table-responsive">
        <table class="table table-bordered shadow-sm bg-white">
          @forelse($agenda as $item)
            <tr>
              <td width="160"><strong>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</strong></td>
              <td>{{ $item->judul }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="2" class="text-center text-muted py-3">Belum ada agenda.</td>
            </tr>
          @endforelse
        </table>
      </div>

    </div>
  </div>

  {{-- FOOTER --}}
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
