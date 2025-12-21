<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakPublicController extends Controller
{
    // tampilkan view kontak (form + info)
    public function index()
    {
        // kalau mau ambil data kontak umum (mis. dari DB), bisa pass di sini.
        return view('kontak');
    }

    // proses form kirim pesan dari publik
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Kontak::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('kontak.index')->with('success', 'Pesan berhasil terkirim. Terima kasih!');
    }
}
