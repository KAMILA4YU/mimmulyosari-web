<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kesiswaan;
use App\Models\PengaturanKesiswaan;
use Illuminate\Support\Facades\Storage;

class KesiswaanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('tab')) {
            session(['active_tab' => $request->tab]);
        }

        return view('admin.kesiswaan', [
            'ekskul' => Kesiswaan::where('kategori','ekskul')->get(),
            'organisasi' => Kesiswaan::where('kategori','organisasi')->get(),
            'keagamaan' => Kesiswaan::where('kategori','keagamaan')->get(),
            'prestasi' => Kesiswaan::where('kategori', 'prestasi')
                ->orderBy('created_at', 'desc')
                ->paginate(10),
            'pembinaan' => Kesiswaan::where('kategori','pembinaan')->get(),
            'pengaturan' => PengaturanKesiswaan::first()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'judul' => 'required|string|max:255', 
            // 'foto' => 'nullable|image'
        ]);

        Kesiswaan::create($validated);

        return redirect()
            ->route('admin.kesiswaan.index')
            ->with('success','Ekskul tersimpan')
            ->with('active_tab', $request->active_tab ?? 'ekskul');

    }

    public function update(Request $request, $id)
    {
        $item = Kesiswaan::findOrFail($id);

        // Jika kategori = prestasi → pakai field judul & gambar
        if ($request->kategori === 'prestasi') {

            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
            ]);

            // Upload gambar baru
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('prestasi', 'public');
                $item->gambar = $path;
            }

            $item->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => 'prestasi',
            ]);

            return redirect()
                ->route('admin.kesiswaan.index')
                ->with('success', 'Prestasi berhasil diperbarui!')
               ->with('active_tab', $request->active_tab ?? 'ekskul');

        }

        // =============================
        // Update untuk kategori lain
        // =============================
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pembimbing' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kesiswaan', 'public');
            $item->gambar = $path;
        }

        $item->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'pembimbing' => $request->pembimbing,
            'kategori' => $request->kategori,
        ]);

        return redirect()
            ->route('admin.kesiswaan.index')
            ->with('success', 'Data kesiswaan berhasil diperbarui!')
            ->with('active_tab', $request->active_tab);

    }

    public function destroy(Request $request, $id)
    {
        $item = Kesiswaan::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('admin.kesiswaan.index')
            ->with('success', 'Data kesiswaan berhasil dihapus!')
            ->with('active_tab', $request->active_tab ?? 'ekskul');
    }

    // public function edit($id)
    // {
    //     $data = Kesiswaan::findOrFail($id);
    //     return view('admin.kesiswaan.edit', compact('data'));
    // }

    private function storeByKategori(Request $request, $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pembimbing' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Kesiswaan::create([
            'kategori' => $kategori,
            'nama' => $request->nama,
            'pembimbing' => $request->pembimbing,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.kesiswaan.index')
            ->with('success', ucfirst($kategori) . ' berhasil ditambahkan!')
            ->with('active_tab', $request->active_tab ?? 'ekskul');

    }

    public function storeEkskul(Request $request)
    {
        return $this->storeByKategori($request, 'ekskul');
    }

    public function storeOrganisasi(Request $request)
    {
        return $this->storeByKategori($request, 'organisasi');
    }

    public function storeKeagamaan(Request $request)
    {
        return $this->storeByKategori($request, 'keagamaan');
    }

    public function storePrestasi(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('prestasi', 'public');
        }

        Kesiswaan::create([
            'kategori' => 'prestasi',
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path, // ✔️ gunakan kolom yang ada di tabel!
        ]);

        return redirect()
            ->route('admin.kesiswaan.index')
            ->with('success', 'Prestasi berhasil ditambahkan!')
            ->with('active_tab', $request->active_tab);

    }

    public function storePembinaan(Request $request)
    {
        return $this->storeByKategori($request, 'pembinaan');
    }


    public function updatePengaturan(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'foto_header' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
        ]);

        $pengaturan = PengaturanKesiswaan::first() ?? new PengaturanKesiswaan();

        if ($request->hasFile('foto_header')) {

            // hapus foto lama
            if ($pengaturan->foto_header && Storage::disk('public')->exists($pengaturan->foto_header)) {
                Storage::disk('public')->delete($pengaturan->foto_header);
            }

            // SIMPAN KE STORAGE
            $path = $request->file('foto_header')->store(
                'kesiswaan',
                'public'
            );

            $pengaturan->foto_header = $path;
        }

        $pengaturan->deskripsi = $request->deskripsi;
        $pengaturan->save();

        return redirect()
            ->route('admin.kesiswaan.index')
            ->with('success', 'Pengaturan halaman berhasil diperbarui!')
            ->with('active_tab', 'pengaturan');
    }

}
