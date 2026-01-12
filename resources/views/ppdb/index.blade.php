<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PPDB Online | MI Muhammadiyah Mulyosari</title>

  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
  body {
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .overlay {
    background-color: rgba(255, 255, 255, 0.93);
    min-height: 100vh;
    padding: 120px 20px 40px;
  }

  .overlay .container {
  max-width: 900px;
}


  @media (min-width: 768px) {
    .overlay {
      padding: 120px 60px 40px;
    }
  }

  .title-page {
    font-size: clamp(1.9rem, 3.5vw, 2.6rem);
  font-weight: 800;
  color: #1f3a4c;
  margin-bottom: 1rem;
    text-align: center;
    position: relative;
    display: inline-block;
  }

  h2, h3, h4 {
    color: #1f3a4c;
  }

  /* Card */
  .ppdb-card {
  border-radius: 18px;
  padding: 28px;
  background: #fff;
  box-shadow: 0 10px 28px rgba(0,0,0,.12);
  transition: .3s ease;
}

.ppdb-card:hover {
  transform: translateY(-3px);
}


 .ppdb-card ul {
  padding-left: 1.2rem;
}

.ppdb-card li {
  margin-bottom: .6rem;
  line-height: 1.7;
}


  /* Text */
  .intro-text {
    max-width: 720px;
  margin: 0 auto 2.5rem;
  line-height: 1.8;
  color: #555;
  }

  /* Button */
  .btn-primary {
  padding: 14px 36px;
  border-radius: 14px;
  font-weight: 600;
  font-size: 1.05rem;
}

.ppdb-card {
  max-width: 720px;
  margin: 0 auto 1.5rem;
}

@media (min-width: 992px) {
  .ppdb-card {
    max-width: 680px;
  }
}

@media (max-width: 576px) {
  .overlay {
    padding-top: 110px;
  }

  .ppdb-card {
    padding: 22px;
  }
}

.ppdb-list {
  list-style: none;
  padding-left: 0;
}

.ppdb-list li {
  display: flex;
  gap: 10px;
  align-items: flex-start;
  margin-bottom: .75rem;
  font-size: 15.5px;
  line-height: 1.7;
}

.ppdb-list i {
  color: #0d6efd;
  margin-top: 4px;
}

.nowrap {
  white-space: nowrap;
}

</style>

</head>
<body>

  <!-- Navbar -->
  @include('partials.navbar')

  <div class="overlay">
    <div class="container">
      <div class="container text-center">
        <h1 class="title-page">PPDB Online | MIM Mulyosari</h1>
      </div>
      <p class="intro-text text-center">
        Selamat datang di halaman Penerimaan Peserta Didik Baru (PPDB) 
        MI Muhammadiyah Mulyosari. Silakan baca informasi berikut sebelum mendaftar.
      </p>

        <div class="ppdb-card mb-4">
          <h4 class="fw-semibold mb-3">
            <i class="bi bi-pin-angle-fill me-2 text-primary"></i>
            Persyaratan Pendaftaran
          </h4>

          <ul class="ppdb-list">
            <li><i class="bi bi-check-circle-fill"></i> Fotokopi Akta Kelahiran</li>
            <li><i class="bi bi-check-circle-fill"></i> Fotokopi Kartu Keluarga</li>
            <li><i class="bi bi-check-circle-fill"></i> Pas Foto 3x4 (2 lembar)</li>
            <li>
              <i class="bi bi-check-circle-fill"></i>
              Usia minimal <span class="nowrap"><strong>6 tahun</strong></span> pada saat pendaftaran
            </li>
            <li><i class="bi bi-check-circle-fill"></i> Surat pindah bagi siswa pindahan</li>
          </ul>

        </div>

      </div>

      <div class="text-center">
        <a href="{{ route('ppdb.form') }}" class="btn btn-primary btn-lg">Daftar Sekarang</a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".custom-navbar");

    if (window.location.pathname.includes("ppdb")) {
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
