<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil Sekolah | MI Muhammadiyah Mulyosari</title>

  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
  body {
    /* background: url('{{ asset("img/Gambar1.png") }}') no-repeat center center fixed; */
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
  }

  /* Overlay responsive */
  .overlay {
    background: rgba(255, 255, 255, 0.94);
    min-height: 100vh;
    padding-top: 120px;
    padding-bottom: 80px;
  }

  @media (max-width: 576px) {
    .overlay {
      padding-top: 100px;
      padding-left: 12px;
      padding-right: 12px;
    }
  }

  /* Page title (match halaman kesiswaan) */
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
    font-size: 1.55rem;
    font-weight: 700;
    color: #1f3a4c;
    margin-bottom: 1rem;
  }

  @media (max-width: 576px) {
    .section-title {
      font-size: 1.35rem;
    }
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


  /* Tabel */
  table th {
    background: #f1f5f9;
    font-weight: 600;
    width: 220px;
    color: #1f3a4c;
  }
  table td {
    background: white;
  }

  .table-responsive {
    border-radius: 14px;
    overflow: hidden;
  }

    /* ===== STRUKTUR ORGANISASI ===== */
  .organisasi-wrapper {
    margin-top: 10px;
  }

  /* Card */
  .org-card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 8px 22px rgba(0,0,0,.08);
    padding: 18px 14px 22px;
    transition: .35s ease;
    position: relative;
  }

  .org-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 32px rgba(0,0,0,.15);
  }

  /* Foto */
  .org-img-wrapper {
    width: 100%;
    height: 150px;
    margin-bottom: 14px;
    overflow: hidden;
    border-radius: 14px;
  }

  .org-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* Body */
  .org-name {
    font-weight: 700;
    font-size: .95rem;
    color: #1f3a4c;
    margin-bottom: 4px;
  }

  .org-role {
    display: inline-block;
    font-size: .75rem;
    font-weight: 600;
    color: #198754;
    background: rgba(25,135,84,.1);
    padding: 6px 12px;
    border-radius: 20px;
  }

  /* Mobile */
  @media (max-width: 576px) {
    .org-img-wrapper {
      height: 130px;
    }

    .org-name {
      font-size: .9rem;
    }
  }

    .identity-table tr {
    border-bottom: 1px solid #eef2f6;
  }

  .identity-table tr:last-child {
    border-bottom: none;
  }

  .identity-table .label {
    width: 38%;
    font-weight: 600;
    color: #1f3a4c;
    padding: 14px 10px;
    vertical-align: top;
  }

  .identity-table .value {
    padding: 14px 10px;
    color: #333;
  }

  @media (max-width: 576px) {
    .identity-table .label {
      width: 45%;
    }
  }

  .page-profil .overlay {
      padding-top: 0;
      padding-left: 0;
      padding-right: 0; 
  }


</style>

</head>
<body class="page-profil">

  @include('partials.navbar')

  <div class="overlay">
    
  {{-- FOTO SEKOLAH --}}
  <div class="hero-photo">
    <img src="{{ asset('storage/' . $profil->foto_sekolah) }}" alt="Gedung Sekolah">
    <div class="hero-overlay"></div>  
    <div class="school-hero-content">
        <h2>MI Muhammadiyah Mulyosari</h2>
        <p>Gedung & Lingkungan Sekolah</p>
      </div>
  </div>
      
  <div class="container">
      <div class="row g-4 mb-5 align-items-stretch">
      {{-- KIRI : IDENTITAS --}}
      <div class="col-lg-6 d-flex">
      <div class="bg-white shadow-sm rounded-4 p-4 w-100 h-100">

        <h3 class="section-title mb-4">Identitas Sekolah</h3>

        <div class="table-responsive">
          <table class="table table-borderless align-middle mb-0 identity-table">

            <tr>
              <td class="label">Nama Sekolah</td>
              <td class="value">{{ $profil->nama_sekolah ?? 'Belum diisi' }}</td>
            </tr>

            <tr>
              <td class="label">NSM / NPSN</td>
              <td class="value">{{ $profil->npsn ?? '-' }}</td>
            </tr>

            <tr>
              <td class="label">Alamat</td>
              <td class="value">{{ $profil->alamat ?? '-' }}</td>
            </tr>

            <tr>
              <td class="label">Tahun Berdiri</td>
              <td class="value">{{ $profil->tahun_berdiri ?? '-' }}</td>
            </tr>

            <tr>
              <td class="label">Akreditasi</td>
              <td class="value">
                <span class="badge bg-success px-3 py-2">
                  {{ $profil->akreditasi ?? '-' }}
                </span>
              </td>
            </tr>

          </table>
        </div>

      </div>
    </div>


      {{-- KANAN : VISI & MISI --}}
      <div class="col-lg-6 d-flex">
        <div class="bg-white shadow-sm rounded p-4 w-100 h-100 d-flex flex-column">

          <h3 class="section-title mb-3">Visi</h3>
          <p class="lead mb-4">
            {{ $profil->visi ?? 'Visi belum diisi.' }}
          </p>

          <h3 class="section-title mb-3">Misi</h3>
          <ul class="list-group list-group-flush flex-grow-1">
            @foreach(explode("\n", $profil->misi) as $item)
              @if(trim($item) != "")
                <li class="list-group-item px-0">
                  {{ $item }}
                </li>
              @endif
            @endforeach
          </ul>

        </div>
      </div>

    </div>


      {{-- GURU --}}
<h3 class="section-title text-center mb-4">
  Struktur Organisasi Guru
</h3>

<div class="row g-4 justify-content-center organisasi-wrapper">
  @foreach($gurus as $guru)
  <div class="col-xl-2 col-lg-3 col-md-4 col-6 d-flex">

    <div class="org-card w-100 text-center">

      @php
        $fotoGuru = $guru->foto
          ? asset('storage/' . $guru->foto)
          : asset('storage/guru/default-guru.jpg');
      @endphp

      <div class="org-img-wrapper">
        <img src="{{ $fotoGuru }}" alt="{{ $guru->nama }}">
      </div>

      <div class="org-body">
        <h6 class="org-name">{{ $guru->nama }}</h6>
        <span class="org-role">{{ $guru->jabatan }}</span>
      </div>

    </div>

  </div>
  @endforeach
</div>


    </div>
  </div>

  {{-- Footer --}}
  <footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>

  <!-- NAVBAR LOGIC -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
      const navbar = document.querySelector(".custom-navbar");
      navbar.classList.add("navbar-solid");
      navbar.classList.remove("navbar-transparent");
  });
  </script>

</body>
</html>
