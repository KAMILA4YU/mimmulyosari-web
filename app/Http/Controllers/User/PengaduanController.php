<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', auth()->id())
            ->with('balasans')
            ->latest()
            ->get();

        return view('user.pengaduan.pengaduan', compact('pengaduans'));
    }

    public function create()
    {
        return view('user.pengaduan.pengaduan-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required|min:3',
            'pesan' => 'required|min:5',
        ]);

        Pengaduan::create([
            'user_id' => auth()->id(),
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
            'status' => 'Menunggu',
        ]);

        return redirect()
            ->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function show(Pengaduan $pengaduan)
    {
        abort_if($pengaduan->user_id != auth()->id(), 403);

        $pengaduan->load('balasans');

        return view('user.pengaduan.pengaduan-show', compact('pengaduan'));
    }

}
