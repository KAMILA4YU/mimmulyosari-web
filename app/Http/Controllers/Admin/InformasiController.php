<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $pengumuman = Informasi::where('kategori', 'pengumuman')
        ->latest()
        ->paginate(10);

        // $berita      = Informasi::where('kategori', 'berita')->latest()->get();
        $agenda = Informasi::where('kategori', 'agenda')
        ->latest()
        ->paginate(10);

        $allowedTabs = ['pengumuman', 'agenda'];

        return view('admin.informasi', compact('pengumuman', 'agenda'));

        // return view('admin.informasi', [
        //     'pengumuman' => $pengumuman,
        //     'berita' => $berita,
        //     'agenda' => $agenda,
        //     'active_tab' => session('active_tab', 'pengumuman'),
        // ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'nullable|date',
            'kategori' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $gambar = null;
        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar')->store('informasi', 'public');
        }

        Informasi::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'gambar' => $gambar,
        ]);

        return redirect()
    ->route('admin.informasi', ['tab' => $request->kategori])
    ->with('success', 'Berhasil!');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'nullable|date',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:25600'
        ]);

        $info = Informasi::findOrFail($id);

        $gambar = $info->gambar; // keep old image if no new upload

        if($request->hasFile('gambar')){
            if($info->gambar){
                Storage::disk('public')->delete($info->gambar);
            }
            $gambar = $request->file('gambar')->store('informasi', 'public');
        }

        $info->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'isi' => $request->isi,
            'gambar' => $gambar,
        ]);

       return redirect()
    ->route('admin.informasi', ['tab' => $request->active_tab])
    ->with('success', 'Informasi berhasil diperbarui!');

    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

        if($informasi->gambar){
            Storage::disk('public')->delete($informasi->gambar);
        }

        $informasi->delete();

        return redirect()
    ->route('admin.informasi', ['tab' => request('active_tab')])
    ->with('success', 'Informasi berhasil dihapus!');

    }
}
