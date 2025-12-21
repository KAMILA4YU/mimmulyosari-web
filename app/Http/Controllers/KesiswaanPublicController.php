<?php

namespace App\Http\Controllers;

use App\Models\Kesiswaan;
use App\Models\PengaturanKesiswaan;

class KesiswaanPublicController extends Controller
{
    public function index()
    {
        return view('kesiswaan', [
            'pengaturan'  => PengaturanKesiswaan::first(),
            'ekskul'      => Kesiswaan::where('kategori', 'ekskul')->get(),
            'organisasi'  => Kesiswaan::where('kategori', 'organisasi')->get(),
            'keagamaan'   => Kesiswaan::where('kategori', 'keagamaan')->get(),
            'prestasi'    => Kesiswaan::where('kategori', 'prestasi')
                            ->latest()    
                            ->take(5)     
                            ->get(),
            'pembinaan'   => Kesiswaan::where('kategori', 'pembinaan')->get(),
        ]);
    }
}
