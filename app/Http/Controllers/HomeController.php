<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use App\Models\ProfilSekolah;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\InfoKontak;
use App\Models\Kesiswaan;
use App\Models\Visitor;
use App\Models\Siswa;
use App\Models\Guru;

class HomeController extends Controller
{
    public function index()
    {
        $home = HomeSection::first();  
        $profil = ProfilSekolah::first(); 
        $artikels = Artikel::latest()->take(3)->get();
        // $galeris = Galeri::latest()->take(4)->get();
        $info = InfoKontak::first();
        $prestasis = Kesiswaan::where('kategori', 'prestasi')
                  ->latest()
                  ->take(4)
                  ->get();

        $totalSiswa = Siswa::count();
        $totalGuru  = Guru::count();

        // simpan kunjungan
        Visitor::create([
            'ip'   => request()->ip(),
            'page' => 'home'
        ]);

        $totalKunjungan = Visitor::count();

        return view('welcome', compact(
            'home',
            'artikels',
            'prestasis',
            'info',
            'totalSiswa',
            'totalGuru',
            'totalKunjungan'
        ));
    }
}
