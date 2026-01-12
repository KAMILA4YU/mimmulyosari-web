<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MI Muhammadiyah 04 Semarang') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-light">
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="py-4">
        <div class="container">
            @if(isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
