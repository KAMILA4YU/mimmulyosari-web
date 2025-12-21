<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Balasan;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $pengaduans = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengaduan', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan) {
        $pengaduan->load('balasans'); 
        return view('admin.pengaduan-show', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan) 
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai'
        ]);

        $pengaduan->update(['status' => $request->status]);
        return back()->with('success', 'Status pengaduan diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan) {
        $pengaduan->delete();
        return back()->with('success', 'Pengaduan dihapus.');
    }

    public function balas(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->balasans()->create([
            'isi' => $request->isi,
            'admin_id' => auth()->id(),
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }


}
