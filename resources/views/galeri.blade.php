<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.hero-style')
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galeri | MI Muhammadiyah Mulyosari</title>

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
      background-color: rgba(255, 255, 255, 0.92);
      min-height: 100vh;
      padding: 120px 20px 60px;
    }

    /* JUDUL */
    .title-page {
      font-size: 2.6rem;
      font-weight: 800;
      color: #1f3a4c;
      margin-bottom: 2.8rem;
      text-align: center;
      position: relative;
      display: inline-block;
    }

    /* CARD GALERI */
    .gallery-card {
      border: none;
      border-radius: 18px;
      overflow: hidden;
      background: #ffffff;
      box-shadow: 0 6px 16px rgba(0,0,0,0.12);
      transition: 0.3s ease;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .gallery-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 26px rgba(0,0,0,0.18);
    }

    .gallery-img {
      height: 260px;
      object-fit: cover;
      width: 100%;
      transition: .4s ease-in-out;
      box-shadow: inset 0 -8px 12px -10px rgba(0,0,0,0.2);
    }

    .gallery-card:hover .gallery-img {
      transform: scale(1.08);
    }

    .card-body {
      padding: 28px 26px 32px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center; 
    }

    .card-body h5 {
      font-weight: 700;
      font-size: 19px;
      color: #1f3a4c;
      margin-top: 6px;
      margin-bottom: 14px;
      line-height: 1.45;
    }

    .card-body p {
      font-size: 14.5px;
      color: #666;
      line-height: 1.75;
      margin-bottom: 4px;
      display: -webkit-box;
      /* -webkit-line-clamp: 3; */
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    /* RESPONSIVE */
    @media (max-width: 576px) {
      .gallery-img {
        height: 200px;
      }
      .page-title {
        font-size: 30px;
      }
      .overlay {
        padding: 120px 10px 50px;
      }
      .card-body {
        padding: 26px 22px 28px;
        justify-content: flex-start;
    }

    .card-body h5 {
      font-size: 18px;
      margin-top: 10px;
    }
    
    @media (max-width: 576px) {
      .row > div[class*="col-"] {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }

    .pagination {
      gap: 6px;
    }

  }
  </style>
</head>
<body>

  <!-- Navbar -->
  @include('partials.navbar')

  <div class="overlay">
    <div class="container text-center">

      <h1 class="title-page">Galeri Kegiatan</h1>

      <div class="row g-4">
        @forelse ($galeris as $item)
          <div class="col-lg-4 col-md-6 col-sm-6">

            <div class="gallery-card">
              
              <img 
                src="{{ asset('storage/'.$item->gambar) }}" 
                alt="{{ $item->judul }}" 
                class="gallery-img"
              >

              <div class="card-body text-center">
                <h5>{{ $item->judul }}</h5>

                @if ($item->keterangan)
                  <p>{{ $item->keterangan }}</p>
                @endif
              </div>

            </div>

          </div>
        @empty
          <p class="text-center">Belum ada foto galeri.</p>
        @endforelse
      </div>

      <div class="mt-5 d-flex justify-content-center">
        {{ $galeris->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </div>

  <footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
  </footer>

  <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      const navbar = document.querySelector(".custom-navbar");
      navbar.classList.add("navbar-solid");
      navbar.classList.remove("navbar-transparent");
    });
    document.addEventListener("DOMContentLoaded", function () {
  const paragraphs = document.querySelectorAll(".card-body p");

  paragraphs.forEach(p => {
    const words = p.innerText.split(" ");
    let result = "";

    words.forEach((word, index) => {
      result += word + " ";
      if ((index + 1) % 6 === 0) {
        result += "<br>";
      }
    });

    p.innerHTML = result.trim();
  });
});
</script>

</body>
</html>
