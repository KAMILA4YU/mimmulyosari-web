<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Pendaftaran PPDB | MI Muhammadiyah Mulyosari</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background: url('{{ asset("img/Gambar1.png") }}') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .overlay {
      background-color: rgba(255, 255, 255, 0.9);
      min-height: 100vh;
      padding: 120px 60px 20px;
    }
    h1, h2, h3 {
      color: #1f3a4c;
    }
  </style>
</head>
<body>

  {{-- Navbar --}}
  @include('partials.navbar')

  <div class="overlay">
    <div class="container">
      <h1 class="text-center fw-bold mb-5">Hasil Pendaftaran PPDB</h1>

      {{-- Pesan sukses --}}
      @if(session('success'))
        <div class="alert alert-success text-center">
          {{ session('success') }}
        </div>
      @endif

      {{-- Data Pendaftar --}}
      <div class="card shadow p-4">
        <h3 class="mb-3">Data Calon Peserta Didik</h3>
        <table class="table table-bordered">
          <tr>
            <th>Nama Lengkap</th>
            <td>{{ $data->nama ?? '-' }}</td>
          </tr>
          <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $data->tempat_lahir ?? '-' }}, {{ $data->tanggal_lahir ?? '-' }}</td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td>{{ $data->alamat ?? '-' }}</td>
          </tr>
          <tr>
            <th>Nama Orang Tua / Wali</th>
            <td>{{ $data->nama_ortu ?? '-' }}</td>
          </tr>
          <tr>
            <th>No. HP</th>
            <td>{{ $data->no_hp ?? '-' }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  {{-- Footer --}}
  <footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".custom-navbar");
    if (window.location.pathname.includes("ppdb")) {
      navbar.classList.add("navbar-solid");
      navbar.classList.remove("navbar-transparent");
    }
  });
  </script>
</body>
</html>
