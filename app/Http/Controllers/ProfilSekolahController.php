<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Guru;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        // Ambil data profil sekolah (ambil baris pertama)
        $profil = ProfilSekolah::first();
        $gurus = Guru::all();

        return view('profil-sekolah', compact('profil', 'gurus'));
    }
}
