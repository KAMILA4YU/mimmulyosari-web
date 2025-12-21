<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index() {
        $pengaduans = Auth::user()->pengaduans()->latest()->get();
        return view('user.pengaduan', compact('pengaduans'));
    }

    public function create() {
        return view('user.pengaduan-create');
    }

    public function store(Request $request) {
        $request->validate([
            'subjek' => 'required|string',
            'pesan' => 'required|string',
        ]);

        Pengaduan::create([
            'user_id' => Auth::id(),
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('user.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim');
    }
}
