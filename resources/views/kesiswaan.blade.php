<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kesiswaan | MI Muhammadiyah Mulyosari</title>

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
      font-weight: 800;
      font-size: 1.5rem;
      position: relative;
      margin-bottom: 25px;
      color: #1f3a4c;
    }
    .section-title::after {
      content: "";
      width: 60px;
      height: 4px;
      background: #1f3a4c;
      border-radius: 10px;
      position: absolute;
      left: 0;
      bottom: -6px;
    }

    /* HERO FOTO SEKOLAH */
  .hero-photo {
      position: relative;
      width: 100%;
      height: 420px;
      overflow: hidden;
      margin-bottom: 3rem;

  }

  .hero-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
  }

  .hero-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
      z-index: 1;
  }

  /* Text */
  .school-hero-content {
      position: absolute;
        top: 50%;
        left: 8%;
        transform: translateY(-50%);
        z-index: 2;

        padding: 60px;
        color: #fff;
        max-width: 650px;
    }

  .school-hero-content h2 {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    margin-bottom: 8px;
  }

  .school-hero-content p {
    font-size: 1.1rem;
    opacity: .9;
  }

  /* Mobile */
  @media (max-width: 768px) {
   .school-hero-content {
      top: auto;
      bottom: 24px;        
      left: 16px;          
      transform: none;     
      padding: 0;
      max-width: calc(100% - 32px);
      text-align: left;
    }

    .school-hero-content h2 {
      font-size: 2.1rem;   
      line-height: 1.15;
    }

    .school-hero-content p {
      font-size: 1.05rem;
    }
  }

    .kesiswaan-card {
  align-items: center;      /* TENGAH VERTIKAL */
}

.kesiswaan-content {
  max-width: 680px;
  margin: 0 auto;
}

.kesiswaan-section-title {
  font-weight: 700;
  margin-bottom: 1rem;
  position: relative;
  color: #1f3a4c;
}
.kesiswaan-section-title::after {
  content: "";
      width: 60px;
      height: 4px;
      background: #1f3a4c;
      border-radius: 10px;
      position: absolute;
      left: 0;
      bottom: -6px;
}

.section-card .lead {
  text-align: justify;
  line-height: 1.8;
  word-spacing: 1px;
  max-width: 100%;
  hyphens: auto;
  text-indent: 1.2em;
}

@media (max-width: 768px) {
  .kesiswaan-card {
    align-items: flex-start;
  }
}

    .section-card {
  background: white;
  border-radius: 16px;
  padding: 36px 40px;
  height: 100%;
}

.section-title {
  font-weight: 700;
  margin-bottom: 1rem;
}

/* .section-card .lead {
  text-align: justify;
  line-height: 1.8;
  word-spacing: 1px;
  hyphens: auto;
} */


@media (max-width: 991px) {
  .section-card {
    height: auto;
    padding: 24px 22px
  }
}


    .ekskul-card {
      border-radius: 16px;
      overflow: hidden;
      transition: 0.3s ease;
      border: none;
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }
    .ekskul-card:hover {
      transform: translateY(-5px);
    }

    .prestasi-card {
      border-radius: 16px !important;
      overflow: hidden;
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
      border: none;
      margin-bottom: 25px;
      background: white;
    }

    .prestasi-img {
      width: 100%;
      height: 200px;                 
      object-fit: cover;
      border-radius: 0;
    }

    .prestasi-img-wrapper {
  width: 100%;
  height: 200px;            /* tinggi seragam */
  overflow: hidden;
  border-radius: 12px;
}

.prestasi-img-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;        /* auto crop */
  object-position: center;
}


    @media (max-width: 576px) {
      .overlay {
        padding: 120px 20px 60px;
      }
    }

    .page-kesiswaan .overlay {
      padding-top: 0;      
      padding-left: 0;     
      padding-right: 0;    
  }

  </style>
</head>
<body class="page-kesiswaan">

@include('partials.navbar')

<div class="overlay">
@php
  use App\Models\PengaturanKesiswaan;
  if (!isset($pengaturan)) {
      $pengaturan = PengaturanKesiswaan::first();
  }
@endphp

  {{-- FOTO HEADER --}}
  <div class="hero-photo">
    <img src="{{ asset('storage/' . $pengaturan->foto_header) }}">
    <div class="hero-overlay"></div>  
    <div class="school-hero-content">
        <h2>Bidang Kesiswaan</h2>
        <p>Kegiatan siswa MIM Mulyosari</p>
      </div>
  </div>

  <div class="container my-5">
  <div class="row g-4 align-items-stretch">

    <!-- KIRI : TENTANG KESISWAAN -->
    <div class="col-lg-6 d-flex">
      <div class="section-card w-100 d-flex kesiswaan-card">
        <div class="kesiswaan-content">
          <h3 class="kesiswaan-section-title">Tentang Kesiswaan</h3>
          <p class="lead">
            {{ $pengaturan?->deskripsi ?? 'Belum ada deskripsi.' }}
          </p>
        </div>
      </div>
    </div>

    <!-- KANAN -->
    <div class="col-lg-6">
      <div class="row g-4 h-100">

        <!-- EKSTRAKURIKULER (ATAS) -->
        <div class="col-12 d-flex">
          <div class="section-card w-100">
            <h3 class="section-title">Ekstrakurikuler</h3>

            <div class="row g-4">
              @forelse ($ekskul as $e)
              <div class="col-md-6 col-lg-4">
                <div class="card ekskul-card h-100">
                  @if ($e->gambar)
                  <img src="{{ asset('storage/'.$e->gambar) }}"
                       class="img-fluid"
                       style="height: 180px; object-fit: cover;">
                  @endif

                  <div class="card-body">
                    <h5 class="fw-bold">{{ $e->nama }}</h5>
                    @if ($e->pembimbing)
                      <small class="text-muted d-block mb-1">
                        Pembimbing: {{ $e->pembimbing }}
                      </small>
                    @endif
                    <p>{{ $e->deskripsi }}</p>
                  </div>
                </div>
              </div>
              @empty
              <p class="text-muted">Belum ada data ekstrakurikuler.</p>
              @endforelse
            </div>
          </div>
        </div>

        <!-- ORGANISASI (BAWAH) -->
        <div class="col-12 d-flex">
          <div class="section-card w-100">
            <h3 class="section-title">Organisasi Siswa</h3>

            <div class="row g-3">
              @forelse ($organisasi as $org)
              <div class="col-md-6">
                <div class="card shadow-sm border-0 p-3 h-100">
                  <h5 class="fw-bold">{{ $org->nama }}</h5>
                  <p>{{ $org->deskripsi }}</p>
                </div>
              </div>
              @empty
              <p class="text-muted">Belum ada data organisasi siswa.</p>
              @endforelse
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<div class="container">

  <!-- BARIS 1 : PRESTASI (FULL) -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="section-card">
        <h3 class="section-title mb-4">Prestasi Siswa</h3>

        @foreach ($prestasi as $p)
        <div class="prestasi-card card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <div class="prestasi-img-wrapper">
                <img src="{{ asset('storage/'.$p->gambar) }}" alt="Prestasi"
                    class="img-fluid">
              </div>
            </div>

            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-bold">{{ $p->judul }}</h5>
                <p>{{ $p->deskripsi }}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>

  <!-- BARIS 2 : KEAGAMAAN & PEMBINAAN -->
  <div class="row align-items-stretch">

    <!-- KEGIATAN KEAGAMAAN -->
    <div class="col-md-6 mb-4">
      <div class="section-card h-100">
        <h3 class="section-title mb-4">Kegiatan Keagamaan</h3>

        <ul class="list-group">
          @forelse ($keagamaan as $kgm)
          <li class="list-group-item">
            <strong>{{ $kgm->nama }}</strong><br>
            <small class="text-muted">{{ $kgm->deskripsi }}</small>
          </li>
          @empty
          <li class="list-group-item text-muted">
            Belum ada kegiatan keagamaan.
          </li>
          @endforelse
        </ul>
      </div>
    </div>

    <!-- PEMBINAAN -->
    <div class="col-md-6 mb-4">
      <div class="section-card h-100">
        <h3 class="section-title mb-4">Program Pembinaan</h3>

        <ul class="list-group">
          @forelse ($pembinaan as $pb)
          <li class="list-group-item">
            <strong>{{ $pb->nama }}</strong><br>
            <small class="text-muted">{{ $pb->deskripsi }}</small>
          </li>
          @empty
          <li class="list-group-item text-muted">
            Belum ada program pembinaan.
          </li>
          @endforelse
        </ul>
      </div>
    </div>

  </div>
</div>


</div>
</div>

<footer class="bg-dark text-white text-center py-3">
  <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".custom-navbar");
  navbar?.classList.add("navbar-solid");
  navbar.classList.remove("navbar-transparent");
});
</script>

</body>
</html>
