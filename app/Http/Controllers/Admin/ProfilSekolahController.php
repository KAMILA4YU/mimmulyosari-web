<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Storage;
use App\Models\Guru;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $gurus = Guru::all(); 

        return view('admin.profil-sekolah', compact('profil', 'gurus'));
    }

    public function update(Request $request)
    {
        $profil = ProfilSekolah::firstOrCreate([]);

        // Foto Sekolah
        if ($request->update_type === 'foto') {

            $request->validate([
                'foto_sekolah' => 'required|image|max:25600',
            ]);

            if ($profil->foto_sekolah) {
                Storage::delete('public/' . $profil->foto_sekolah);
            }

            $path = $request->file('foto_sekolah')
                ->store('foto_sekolah', 'public');

            $profil->update([
                'foto_sekolah' => $path
            ]);

            return redirect()
                ->route('admin.profil-sekolah', ['tab' => 'identitas'])
                ->with('success', 'Foto sekolah berhasil diperbarui!');

        }

        // Visi Misi
        if ($request->update_type === 'visi_misi') {

            $request->validate([
                'visi' => 'nullable|string',
                'misi' => 'nullable|string',
            ]);

            $profil->update([
                'visi' => $request->visi,
                'misi' => $request->misi,
            ]);

            return redirect()
                ->route('admin.profil-sekolah', ['tab' => 'visi'])
                ->with('success', 'Visi & Misi berhasil diperbarui!');

        }

        // Identitas Sekolah
        $data = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string',
            'npsn' => 'nullable|string',
            'tahun_berdiri' => 'nullable|string',
            'akreditasi' => 'nullable|string',
            'foto_sekolah' => 'nullable|image|max:25600',
        ]);

        if ($request->hasFile('foto_sekolah')) {
            if ($profil->foto_sekolah) {
                Storage::delete('public/' . $profil->foto_sekolah);
            }

            $data['foto_sekolah'] = $request->file('foto_sekolah')
                ->store('foto_sekolah', 'public');
        }

        $profil->update($data);

        return redirect()
            ->route('admin.profil-sekolah', ['tab' => 'identitas'])
            ->with('success', 'Profil sekolah berhasil diperbarui!');

    }

}
