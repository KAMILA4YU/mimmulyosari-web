<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.hero-style')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $item->judul }} | MI Muhammadiyah Mulyosari</title>

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
            padding: 130px 20px 70px;
        }

        /* CONTAINER MAX WIDTH SUPAYA RAPI BANGET DI DESKTOP */
        .news-wrapper {
            max-width: 900px;
            margin: auto;
        }

        /* CARD */
        .news-card {
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 6px 18px rgba(0,0,0,0.10);
            padding: 40px 45px;
        }

        /* JUDUL */
        .judul-berita {
            color: #0d2c54;
            font-weight: 800;
            font-size: 32px;
            line-height: 1.3;
        }

        /* INFO */
        .sub-info {
            color: #666;
            font-size: 15px;
        }

        /* GAMBAR */
        .news-img {
            width: 100%;
            max-height: 440px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.1);
            transition: .25s ease;
        }

        .news-img:hover {
            transform: scale(1.01);
        }

        /* ISI BERITA */
        .content {
            margin-top: 25px;
            font-size: 17px;
            color: #2b2b2b;
            line-height: 1.75;
        }

        .content img {
            max-width: 100%;
            border-radius: 10px;
            margin: 20px 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .news-card {
                padding: 25px 22px;
            }

            .judul-berita {
                font-size: 26px;
            }

            .content {
                font-size: 16px;
            }

            .news-img {
                max-height: 300px;
            }
        }

        @media (max-width: 480px) {
            .judul-berita {
                font-size: 23px;
            }

            .content {
                font-size: 15.5px;
            }

            .news-card {
                padding: 20px;
                border-radius: 14px;
            }
        }
    </style>

</head>
<body>

    @include('partials.navbar')

    <div class="overlay">
        <div class="container news-wrapper">

            {{-- Tombol kembali --}}
            <div class="mb-4">
                <a href="{{ route('berita') }}" class="btn btn-outline-primary rounded-pill px-4 py-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Berita
                </a>
            </div>

            {{-- CARD BERITA --}}
            <div class="news-card">

                {{-- Judul --}}
                <h1 class="judul-berita mb-3">{{ $item->judul }}</h1>

                {{-- Info --}}
                <div class="sub-info mb-4">
                    <i class="bi bi-calendar-event"></i>
                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                </div>

                {{-- Gambar --}}
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="news-img mb-4">
                @endif

                {{-- Isi --}}
                <div class="content">
                    {!! nl2br($item->isi) !!}
                </div>

            </div>

        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white text-center py-3">
        <small>© {{ date('Y') }} MI Muhammadiyah Mulyosari. All rights reserved.</small>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navbar = document.querySelector(".custom-navbar");
            navbar.classList.add("navbar-solid");
        });
    </script>

</body>
</html>
