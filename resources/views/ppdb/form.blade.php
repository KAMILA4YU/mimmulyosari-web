<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulir PPDB | MI Muhammadiyah Mulyosari</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  @include('partials.navbar')

  <div class="overlay bg-light py-5">
    <div class="container">
      <h1 class="text-center fw-bold mb-4">Formulir Pendaftaran Peserta Didik Baru</h1>
      <p class="text-center mb-5 text-muted">
        Silakan isi formulir berikut dengan data yang benar dan lengkap.
      </p>

      <!-- Error validation -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Formulir -->
      <form action="{{ route('ppdb.store') }}" method="POST" class="card shadow-sm p-4 border-0 rounded-4">
        @csrf

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
          </div>

          <div class="col-md-6">
            <label for="nisn" class="form-label fw-semibold">NISN</label>
            <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan NISN" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
          <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
        </div>

        <div class="mb-3">
          <label for="no_hp" class="form-label fw-semibold">Nomor HP Orang Tua/Wali</label>
          <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Contoh: 081234567890" required>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
            Kirim Pendaftaran
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>
</body>
</html>
