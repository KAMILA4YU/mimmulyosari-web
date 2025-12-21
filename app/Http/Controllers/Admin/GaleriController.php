<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Tampilkan semua data galeri (di dashboard admin)
    public function index()
    {
        $galeris = Galeri::latest()->paginate(10);
        return view('admin.galeri', compact('galeris'));
    }

    // Simpan foto baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:25600',
            'keterangan' => 'nullable|string',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'gambar' => $path,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan!');
    }

    // Update foto
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:25600',
            'keterangan' => 'nullable|string',
        ]);

        $data = [
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return back()->with('success', 'Foto berhasil diperbarui!');
    }

    // Hapus foto
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }

    public function showPublic()
    {
        $galeris = Galeri::latest()->paginate(10);
        return view('galeri', compact('galeris'));
    }
}
