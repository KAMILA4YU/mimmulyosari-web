<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaPublicController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(6); // atur jumlah per halaman sesuai keinginan
        return view('berita', compact('berita'));
    }

    public function show($slug)
    {
        $item = Berita::where('slug', $slug)->firstOrFail();
        return view('berita_detail', compact('item'));
    }

}
