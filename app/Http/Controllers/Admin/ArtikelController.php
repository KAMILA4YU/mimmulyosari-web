<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('admin.artikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|max:25600',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create($data);

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|max:25600',
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->delete();

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil dihapus!');
    }

    public function showPublic()
    {
        $artikels = \App\Models\Artikel::latest()->get();
        return view('artikel', compact('artikels'));
    }

    public function showDetail($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel-detail', compact('artikel'));
    }

}
