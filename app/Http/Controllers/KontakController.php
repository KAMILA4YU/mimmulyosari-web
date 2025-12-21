<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\InfoKontak;

class KontakController extends Controller
{
     public function index()
    {
        $info = InfoKontak::first(); // ambil info kontak
        return view('kontak', compact('info'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        Kontak::create($request->only('nama', 'email', 'pesan'));

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
