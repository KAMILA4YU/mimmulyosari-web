<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kontak | MI Muhammadiyah Mulyosari</title>

  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  @php
    $info = \App\Models\InfoKontak::first();
  @endphp

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
  body {
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .overlay {
    background-color: rgba(255, 255, 255, 0.95);
    min-height: 100vh;
    padding: 120px 20px 40px; /* lebih kecil & responsive */
  }

  @media (min-width: 768px) {
    .overlay {
      padding: 120px 60px 40px;
    }
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

  h2, h3 {
    color: #1f3a4c;
  }

  /* Contact card */
  .contact-card {
    border-radius: 18px;
    padding: 30px;
    background: #ffffff;
    box-shadow: 0 8px 22px rgba(0,0,0,0.12);
    transition: .3s ease;
    border: 1px solid #eee;
  }

  .contact-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.18);
  }

  /* Text style */
  .contact-card p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 10px;
    font-size: 15px;
  }

  /* Form */
  .form-control {
    padding: 12px;
    border-radius: 10px;
  }

  .btn-primary {
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
  }

  /* Google Maps responsivity already good */
  .ratio {
    border-radius: 15px;
    overflow: hidden;
  }
</style>

</head>
<body>

  {{-- Navbar --}}
  @include('partials.navbar')

  <div class="overlay">
    <div class="container">
      <div class="container text-center">
        <h1 class="title-page">Kontak Kami</h1>
      </div>

      <div class="row g-4 align-items-stretch">

        <!-- Info Kontak -->
        <div class="col-md-6">
          <div class="contact-card h-100">
            <h3 class="mb-3">Informasi Sekolah</h3>
            <p><strong>Alamat:</strong> {{ $info->alamat }}</p>
            <p><strong>Telepon:</strong> {{ $info->telepon }}</p>
            <p><strong>Email:</strong> {{ $info->email }}</p>
            <p><strong>Website:</strong> {{ $info->website }}</p>
            <p><strong>Jam Operasional:</strong> {{ $info->jam_operasional }}</p>
          </div>
        </div>

        <!-- Form Kontak -->
        <div class="col-md-6">
          <div class="contact-card h-100">
            <h3 class="mb-3">Kirim Pesan</h3>
            <form action="{{ route('kontak.kirim') }}" method="POST">
              @csrf

              @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif

              <div class="mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="name" name="nama" required>
              </div>

              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
              </div>

              <div class="mb-3">
                  <label for="subjek" class="form-label">Subjek</label>
                  <input type="text" class="form-control" id="subjek" name="subjek" required>
              </div>

              <div class="mb-3">
                  <label for="message" class="form-label">Pesan</label>
                  <textarea class="form-control" id="message" name="pesan" rows="4" required></textarea>
              </div>

              <button type="submit" class="btn btn-primary w-100">Kirim</button>
          </form>
          </div>
        </div>
      </div>

      <!-- Peta -->
      <div class="row mt-5">
        <div class="col-12">
          <h3 class="text-center mb-3">Lokasi Kami</h3>
          <div class="ratio ratio-16x9 shadow rounded">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.1011220698088!2d110.01218647501007!3d-7.114279069762364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706c4c994664e7%3A0x8e8dc6a1cbcf7daf!2sMI%20Muhammadiyah%20Mulyosari!5e0!3m2!1sen!2sid!4v1765526897113!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
              width="600" height="450" style="border:0;" 
              allowfullscreen="" loading="lazy">
            </iframe>
          </div>
        </div>
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
    if (window.location.pathname.includes("kontak")) {
      navbar.classList.add("navbar-solid");
      navbar.classList.remove("navbar-transparent");
    }
  });
  </script>

</body>
</html>
