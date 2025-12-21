<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::query();

        // fitur search
        if ($request->cari) {
            $query->where('judul', 'like', '%' . $request->cari . '%')
                  ->orWhere('isi', 'like', '%' . $request->cari . '%');
        }

        // pagination
        $artikels = $query->latest()->paginate(6);

        return view('artikel', compact('artikels'));
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel-detail', compact('artikel'));
    }
}
