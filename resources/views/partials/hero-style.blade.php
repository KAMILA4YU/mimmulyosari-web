@php
    $heroBg = ($homeSection && $homeSection->gambar_hero)
        ? asset('storage/'.$homeSection->gambar_hero)
        : (
            $profilSekolah && $profilSekolah->foto_sekolah
                ? asset('storage/'.$profilSekolah->foto_sekolah)
                : asset('img/Gambar1.png')
        );
@endphp

<style>
    body {
        background: url('{{ $heroBg }}') no-repeat center center fixed;
        background-size: cover;
    }
</style>
