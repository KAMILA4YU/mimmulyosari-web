<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MI Muhammadiyah Mulyosari</title>
  
  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  @php $home = \App\Models\HomeSection::first(); @endphp

<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    background-image: url('{{ asset("storage/" . $home->gambar_hero) }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }

  /* ===== NAVBAR ===== */
  .custom-navbar {
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 999;
    padding: 14px 0;
    transition: .3s ease;
  }

  .navbar-transparent {
    background-color: transparent !important;
    box-shadow: none;
  }

  .navbar-solid {
    background-color: rgba(255, 255, 255, .9) !important;
    backdrop-filter: blur(8px);
    box-shadow: 0 2px 10px rgba(0,0,0,.1);
  }

  .hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 60px 15px;
    text-align: center;
    color: #fff;
    background: rgba(0,0,0,.5);
  }

  .hero h1 {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
    position: relative;
  display: inline-block;
  transition: transform .4s ease, letter-spacing .4s ease;
  }

  .hero h1::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: -12px;
  width: 60%;
  height: 4px;
  background: linear-gradient(90deg, #20c997, #28a745);
  transform: translateX(-50%) scaleX(0);
  transform-origin: center;
  transition: transform .45s ease;
  border-radius: 4px;
}

/* DESKTOP HOVER */
@media (hover: hover) {
  .hero h1:hover {
    transform: translateY(-4px);
    letter-spacing: 1px;
    text-shadow: 0 0 18px rgba(255,255,255,.35);
  }

  .hero h1:hover::after {
    transform: translateX(-50%) scaleX(1);
  }
}

/* MOBILE TAP */
@media (hover: none) {
  .hero h1:active {
    /* transform: scale(.96); */
    transform: scale(1.06);
    text-shadow: 0 8px 25px rgba(0,0,0,.35);
  }

  .hero h1:active::after {
    transform: translateX(-50%) scaleX(1);
  }
}

  .hero h2 {
    font-size: clamp(1.2rem, 3vw, 1.8rem);
    transition: transform .35s ease, letter-spacing .35s ease;
  }
  .hero p {
    max-width: 750px;
    margin: 15px auto;
    font-size: 1.1rem;
    transition: transform .35s ease, letter-spacing .35s ease;
  }

  .hero h2:active,
  .hero p:active {
    transform: scale(1.04);
    text-shadow: 0 8px 25px rgba(0,0,0,.35);
  }

  /* Button modern */
.hero .btn-hero {
  margin-top: 28px;
  padding: 14px 36px;
  border-radius: 999px;
  font-size: 1.1rem;
  font-weight: 600;
  letter-spacing: .3px;
  color: #fff;
  border: 2px solid rgba(255,255,255,.9);
  background: transparent;
  position: relative;
  overflow: hidden;
  transition:
    transform .35s cubic-bezier(.22,.61,.36,1),
    box-shadow .35s cubic-bezier(.22,.61,.36,1),
    background .35s ease,
    color .35s ease;
}

/* SHINE EFFECT */
.hero .btn-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    120deg,
    transparent,
    rgba(255,255,255,.35),
    transparent
  );
  transform: translateX(-120%);
  transition: transform .6s ease;
}

/* DESKTOP HOVER */
@media (hover: hover) {
  .hero .btn-hero:hover {
    background: #fff;
    color: #000;
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(0,0,0,.35);
  }

  .hero .btn-hero:hover::before {
    transform: translateX(120%);
  }
}

/* MOBILE TAP */
@media (hover: none) {
  .hero .btn-hero:active {
    transform: scale(.96);
    box-shadow: 0 10px 25px rgba(0,0,0,.35);
    background: rgba(255,255,255,.15);
  }
}

@media (prefers-reduced-motion: reduce) {
  .hero .btn-hero,
  .hero .btn-hero::before {
    transition: none !important;
  }
}

  /* ===== HERO ENTRY ANIMATION ===== */
.hero h1,
.hero h2,
.hero p,
.hero .btn-hero {
  opacity: 0;
  animation-fill-mode: forwards;
}

/* DESKTOP */
@media (min-width: 768px) {
  .hero h1 {
    animation: heroDown .9s ease .1s forwards;
  }

  .hero h2 {
    animation: heroDown .9s ease .25s forwards;
  }

  .hero p {
    animation: heroUp .9s ease .4s forwards;
  }

  .hero .btn-hero {
    animation: heroZoom .9s ease .55s forwards;
  }
}

/* MOBILE */
@media (max-width: 767px) {
  .hero h1,
  .hero h2,
  .hero p,
  .hero .btn-hero {
    animation: heroFade 1.4s cubic-bezier(.22,.61,.36,1) forwards;
  }

  .hero h1 { animation-delay: .15s; }
  .hero h2 { animation-delay: .35s; }
  .hero p  { animation-delay: .6s; }
  .hero .btn-hero { animation-delay: .85s; }
}


/* ===== KEYFRAMES ===== */
@keyframes heroDown {
  from {
    opacity: 0;
    transform: translateY(-28px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes heroUp {
  from {
    opacity: 0;
    transform: translateY(28px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes heroZoom {
  from {
    opacity: 0;
    transform: scale(.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes heroFade {
  from {
    opacity: 0;
    transform: translateY(18px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}


  /* ===== GENERAL SECTION SPACING ===== */
  section {
    scroll-margin-top: 80px;
  }

  /* ===== SAMBUTAN ===== */
  #sambutan img {
    width: 100%;
    object-fit: cover;
    max-height: 320px;
  }

  @media (max-width: 768px) {
    #sambutan .col-md-8 {
      text-align: center;
    }
    #sambutan hr {
      margin-left: auto;
      margin-right: auto;
    }
  }

  /* ===== PROFIL ===== */
  #profil img {
    max-width: 80%;
  }

  @media (max-width: 768px) {
    #profil img {
      max-width: 100%;
    }
  }

  /* ===== ARTIKEL ===== */
  .card-img-top {
    height: 200px;
    object-fit: cover;
  }

  /* ===== GALERI ===== */
  #galeri img {
    height: 160px;
    object-fit: cover;
    width: 100%;
  }

  @media (max-width: 576px) {
    #galeri img {
      height: 130px;
    }
  }

  #galeri {
    position: relative;
    background-image: url('{{ asset("storage/" . $home->gambar_hero) }}'); /* atau background lain */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }

  #galeri::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45); /* tingkat gelapnya – bisa diubah 0.3–0.6 */
    z-index: 1;
  }

  #galeri .container {
    position: relative;
    z-index: 2; 
  }

  #statistik .rounded {
    background: linear-gradient(180deg, #ffffff, #f8f9fa);
  }

  #statistik i {
    opacity: .9;
  }

  .article-img {
    height: 200px;          
    object-fit: cover;      
    width: 100%;
    border-top-left-radius: .5rem;
    border-top-right-radius: .5rem;
  }

  .article-img {
    height: 220px;
    object-fit: cover;
}

@media (min-width: 768px) {
    .article-img {
        height: 200px;
    }
}

@media (min-width: 992px) {
    .article-img {
        height: 180px;
    }
}

.ppdb-floating {
    position: fixed;
    bottom: 24px;
    right: 24px;
    width: 320px;
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 18px 18px 20px;
    z-index: 9999;
    box-shadow: 0 15px 40px rgba(0,0,0,.15);
    animation: floatIn .7s cubic-bezier(.25,.8,.25,1);
    cursor: grab;
}

@media (min-width: 577px) {
    .ppdb-floating {
      animation: floatIn .7s cubic-bezier(.25,.8,.25,1),
                 floating 3.5s ease-in-out infinite;
    }
}

.ppdb-floating:active {
    cursor: grabbing;
}

@keyframes floatIn {
    from {
        transform: translateY(40px) scale(.95);
        opacity: 0;
    }
    to {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}

@keyframes floating {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}

.ppdb-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg,#28a745,#20c997);
    color: #fff;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    animation: pulse 1.8s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(40,167,69,.5); }
    70% { box-shadow: 0 0 0 12px rgba(40,167,69,0); }
    100% { box-shadow: 0 0 0 0 rgba(40,167,69,0); }
}

.ppdb-floating-content {
    font-size: 14px;
    line-height: 1.6;
}

.ppdb-floating .close-btn {
    position: absolute;
    top: 10px;
    right: 12px;
    background: none;
    border: none;
    font-size: 14px;
    color: #999;
}

.ppdb-floating .close-btn:hover {
    color: #000;
}

@keyframes slideUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* MOBILE */
@media (max-width: 576px) {
   .ppdb-floating {
    left: auto;
    right: -65%;
    bottom: 16px;
    width: 90%;
    max-width: 420px;
    transition: transform .4s ease, right .4s ease;
  }

  /* posisi peek */
  .ppdb-floating.peek {
    right: -65%;
  }

  /* posisi full */
  .ppdb-floating.open {
    right: 5%;
  }
}


.ppdb-marquee {
    overflow: hidden;
    white-space: nowrap;
    font-size: 13px;
    color: #555;
    margin-bottom: 8px;
}

.ppdb-marquee span {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 10s linear infinite;
}

@keyframes marquee {
    from { transform: translateX(0); }
    to { transform: translateX(-100%); }
}

  /* ===== FOOTER ===== */
  footer {
    font-size: .9rem;
  }
</style>

</head>
<body>

  @include('partials.navbar')

  {{-- HERO --}}
  <section class="hero">
    <div class="container">
      <h1>{{ $home->judul_hero }}</h1>
      <h2>{{ $home->subjudul_hero }}</h2>
      <p>{{ $home->slogan_hero }}</p>
      <a href="{{ route('profil.sekolah') }}" class="btn btn-outline-light btn-hero">
        Lihat Profil Sekolah
      </a>
    </div>
  </section>

@if($home && $home->ppdb_status === 'dibuka')
<div class="ppdb-floating shadow">
    <button class="close-btn" onclick="this.parentElement.style.display='none'">
        <i class="bi bi-x-lg"></i>
    </button>

    <div class="ppdb-floating-content">
        <div class="ppdb-marquee">
    <span>📢 PPDB {{ $home->ppdb_periode }} TELAH DIBUKA • {{ $home->ppdb_gelombang }}</span>
</div>


        <h6 class="fw-bold mb-2">
            PPDB {{ $home->ppdb_periode }}
        </h6>

        <p class="mb-2 small">
            {{ $home->ppdb_keterangan }}
        </p>

        <span class="badge bg-primary">
            {{ $home->ppdb_gelombang }}
        </span>
    </div>
</div>
@endif


  {{-- SAMBUTAN KEPALA SEKOLAH --}}
  <section id="sambutan" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center fw-bold text-success mb-4">KABAR TERKINI</h2>
      <p class="text-center text-muted mb-5">Informasi terbaru dari MI Muhammadiyah Mulyosari</p>

      <div class="row align-items-center g-4">
        <div class="col-md-4 text-center">
            <div class="sambutan-img">
                <img src="{{ asset('storage/'.$home->gambar_sambutan) }}"
                    alt="Kepala Sekolah">
            </div>
        </div>

        <div class="col-md-8">
          <h4 class="fw-bold">{{ $home->judul_sambutan }}</h4>
          <hr class="mb-3" style="max-width: 100px; border-top:3px solid #198754;">
          <p class="text-justify">{!! nl2br(e($home->deskripsi_sambutan)) !!}</p>
        </div>
      </div>
    </div>
  </section>

  {{-- PROFIL --}}
  <section id="profil" class="py-5 text-center bg-white">
    <div class="container">
      <h2 class="mb-3 text-success">{{ $home->judul_tentang }}</h2>
      <p class="lead">{{ $home->deskripsi_tentang }}</p>

      @if($home->gambar_tentang)
        <img src="{{ asset('storage/'.$home->gambar_tentang) }}" class="img-fluid rounded shadow mt-3">
      @endif
    </div>
  </section>

  {{-- ARTIKEL --}}
  <section id="artikel" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center text-success mb-4">Artikel & Berita</h2>
      <div class="row g-4">
        @foreach($artikels as $artikel)
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="{{ $artikel->gambar ? asset('storage/' . $artikel->gambar) : asset('img/default-article.jpg') }}"
                class="card-img-top article-img"
                alt="{{ $artikel->judul }}">
            <div class="card-body d-flex flex-column">
              <h5>{{ $artikel->judul }}</h5>
              <p class="text-muted">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
              <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-primary mt-auto">
                Baca Selengkapnya →
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- STATISTIK SEKOLAH --}}
  <section id="statistik" class="py-5 bg-white">
    <div class="container">
      <div class="row text-center g-4">

        <div class="col-6 col-md-4">
          <div class="p-4 rounded shadow-sm h-100">
            <i class="bi bi-people-fill fs-1 text-success"></i>
            <h3 class="fw-bold mt-2 counter" data-target="{{ $totalSiswa }}">0</h3>
            <p class="text-muted mb-0">Total Siswa</p>
          </div>
        </div>

        <div class="col-6 col-md-4">
          <div class="p-4 rounded shadow-sm h-100">
            <i class="bi bi-mortarboard-fill fs-1 text-primary"></i>
            <h3 class="fw-bold mt-2 counter" data-target="{{ $totalGuru }}">0</h3>
            <p class="text-muted mb-0">Pengajar</p>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="p-4 rounded shadow-sm h-100">
            <i class="bi bi-bar-chart-fill fs-1 text-warning"></i>
            <h3 class="fw-bold mt-2 counter" data-target="{{ $totalKunjungan }}">0</h3>
            <p class="text-muted mb-0">Kunjungan Website</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- GALERI --}}
  <section id="galeri" class="py-5">
  <div class="container text-center">

    <h2 class="section-title text-white">Prestasi Sekolah</h2>
    <p class="section-subtitle text-light">Pencapaian terbaik siswa MI Muhammadiyah Mulyosari</p>

    <div class="row g-3 mt-4">
      @foreach ($prestasis as $p)
      <div class="col-6 col-md-3">

        <img src="{{ asset('storage/' . $p->gambar) }}" 
             class="img-fluid rounded shadow-sm mb-2">

        <small class="text-white d-block fw-bold">
            {{ Str::limit($p->judul, 40) }}
        </small>

      </div>
      @endforeach
    </div>

  </div>
</section>


  {{-- KONTAK --}}
  <section id="kontak" class="py-5 bg-white">
    <div class="container">
      <h2 class="text-success fw-bold text-center mb-5">Hubungi Kami</h2>
      <div class="row justify-content-center g-4">

        <div class="col-md-6">
          <ul class="list-unstyled fs-5">
            <li class="mb-3"><strong>📍 Alamat:</strong><br>{{ $info->alamat }}</li>
            <li class="mb-3"><strong>📞 Telepon:</strong> <a href="tel:{{ $info->telepon }}" class="text-dark text-decoration-none">{{ $info->telepon }}</a></li>
            <li class="mb-3"><strong>✉️ Email:</strong> <a href="mailto:{{ $info->email }}" class="text-dark text-decoration-none">{{ $info->email }}</a></li>
            <li class="mb-3"><strong>💻 Website:</strong> <a href="{{ $info->website }}" class="text-dark text-decoration-none">{{ $info->website }}</a></li>
          </ul>
        </div>

        <div class="col-md-6">
          <h5 class="fw-bold mb-3">Media Sosial:</h5>
          <ul class="list-unstyled fs-5">
            @if($home->facebook)
              <li class="mb-2"><i class="bi bi-facebook text-primary me-2"></i><a href="{{ $home->facebook }}" target="_blank" class="text-dark text-decoration-none">Facebook</a></li>
            @endif
            @if($home->instagram)
              <li class="mb-2"><i class="bi bi-instagram text-danger me-2"></i><a href="{{ $home->instagram }}" target="_blank" class="text-dark text-decoration-none">Instagram</a></li>
            @endif
            @if($home->youtube)
              <li class="mb-2"><i class="bi bi-youtube text-danger me-2"></i><a href="{{ $home->youtube }}" target="_blank" class="text-dark text-decoration-none">YouTube</a></li>
            @endif
            @if($home->twitter)
              <li class="mb-2"><i class="bi bi-twitter text-dark me-2"></i><a href="{{ $home->twitter }}" target="_blank" class="text-dark text-decoration-none">Twitter</a></li>
            @endif
            @if($home->whatsapp)
              <li class="mb-2"><i class="bi bi-whatsapp text-success me-2"></i><a href="https://wa.me/{{ preg_replace('/\D/', '', $home->whatsapp) }}" target="_blank" class="text-dark text-decoration-none">WhatsApp</a></li>
            @endif
          </ul>
        </div>

      </div>
    </div>
  </section>

  {{-- FOOTER RINGKAS --}}
  <section class="py-5 text-white" style="background:#1f3a4c;">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3">
          <h5 class="fw-bold text-uppercase">Tautan</h5>
          <ul class="list-unstyled mt-3">
            <li><a class="text-white text-decoration-none d-block py-1 border-bottom" href="#">Buku Guru & Siswa SP</a></li>
            <li><a class="text-white text-decoration-none d-block py-1 border-bottom" href="#">Buletin Sekolah</a></li>
            <li><a class="text-white text-decoration-none d-block py-1 border-bottom" href="#">RPP Semua Kelas</a></li>
            <li><a class="text-white text-decoration-none d-block py-1 border-bottom" href="#">Soal Online</a></li>
          </ul>
        </div>

        <div class="col-md-3">
          <h5 class="fw-bold text-uppercase">Kunjungi Kami</h5>
          <div class="d-flex gap-3 mt-3">
            <img src="{{ asset('img/fb.png') }}" height="32">
            <img src="{{ asset('img/ig.png') }}" height="32">
            <img src="{{ asset('img/yt.png') }}" height="32">
          </div>
        </div>

        <div class="col-md-3">
          <h5 class="fw-bold text-uppercase">Informasi</h5>
          <ul class="list-unstyled mt-3">
            <li><a class="text-white" href="#artikel">Berita</a></li>
            <li><a class="text-white" href="#artikel">Artikel</a></li>
          </ul>
        </div>

        <div class="col-md-3">
          <h5 class="fw-bold text-uppercase">Lokasi Sekolah</h5>
          <div class="mt-3 rounded overflow-hidden">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.1011220698088!2d110.01218647501007!3d-7.114279069762364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706c4c994664e7%3A0x8e8dc6a1cbcf7daf!2sMI%20Muhammadiyah%20Mulyosari!5e0!3m2!1sen!2sid!4v1765526897113!5m2!1sen!2sid" 
              width="600" height="450" style="border:0;" 
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-dark text-white text-center py-3 small">
    © {{ date('Y') }} MI Muhammadiyah Mulyosari — All rights reserved
  </footer>

<script>
const navbar = document.querySelector('.custom-navbar');

function handleNavbarStyle() {
  if (window.scrollY > 20) {
    navbar.classList.add('navbar-solid');
    navbar.classList.remove('navbar-transparent');
  } else {
    navbar.classList.add('navbar-transparent');
    navbar.classList.remove('navbar-solid');
  }
}

window.addEventListener('load', handleNavbarStyle);
window.addEventListener('scroll', handleNavbarStyle);

document.addEventListener('DOMContentLoaded', () => {
  const counters = document.querySelectorAll('.counter');

  const animateCounter = (counter) => {
    const target = parseInt(counter.dataset.target);

    if (isNaN(target)) {
      console.error('Counter target kosong:', counter);
      return;
    }

    let current = 0;
    const increment = Math.ceil(target / 100);

    const update = () => {
      current += increment;
      if (current < target) {
        counter.innerText = current;
        requestAnimationFrame(update);
      } else {
        counter.innerText = target;
      }
    };

    update();
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target); // jalan sekali
      }
    });
  }, { threshold: 0.4 });

  counters.forEach(counter => observer.observe(counter));
});

document.addEventListener('DOMContentLoaded', () => {
  const ppdb = document.querySelector('.ppdb-floating');
  if (!ppdb || window.innerWidth > 576) return;

  let isOpen = false;

  // auto slide kecil pas awal
  setTimeout(() => {
    ppdb.classList.add('peek');
  }, 500);

  // tap toggle
  ppdb.addEventListener('click', (e) => {
    // biar tombol close tetap jalan
    if (e.target.closest('.close-btn')) return;

    isOpen = !isOpen;

    if (isOpen) {
      ppdb.classList.add('open');
      ppdb.classList.remove('peek');
    } else {
      ppdb.classList.remove('open');
      ppdb.classList.add('peek');
    }
  });
});

</script>

</body>
</html>
