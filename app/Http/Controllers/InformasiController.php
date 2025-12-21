<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Berita;

class InformasiController extends Controller
{
    public function index()
    {
        $pengumuman = Informasi::where('kategori', 'pengumuman')
                        ->orderBy('tanggal', 'DESC')
                        ->take(4)
                        ->get();

        $agenda = Informasi::where('kategori', 'Agenda')
            ->whereDate('tanggal', '>=', now())
            ->orderBy('tanggal', 'ASC')
            ->take(10)
            ->get();


        $berita = Berita::latest()
                        ->take(3)
                        ->get();

        return view('informasi', compact('pengumuman', 'berita', 'agenda'));
    }
}
