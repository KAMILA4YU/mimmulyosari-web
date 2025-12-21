<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = \App\Models\Siswa::count();
        $ppdbAktif = \App\Models\Ppdb::where('status', 'Pending')->count();
        $totalBerita = \App\Models\Berita::count();
        $pengaduanPending = \App\Models\Pengaduan::where('status', 'Menunggu')->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'ppdbAktif',
            'totalBerita',
            'pengaduanPending'
        ));
    }

    public function ppdb()
    {
        return view('admin.ppdb');
    }

    public function guruSiswa()
    {
        $gurus = \App\Models\Guru::all();
        $siswas = \App\Models\Siswa::paginate(10);
        $totalSiswa = \App\Models\Siswa::count();

        return view('admin.guru-siswa.index', compact(
            'gurus',
            'siswas',
            'totalSiswa'
        ));
    }


    // ====================================================
    // 🔥 Tambahan: PROFIL ADMIN
    // ====================================================
    public function profil()
    {
        $admin = Auth::user(); // ambil admin yang login
        return view('admin.profil', compact('admin'));
    }

    public function updateProfil(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8|confirmed',
            'foto'  => 'nullable|image|max:2048',
        ]);

        $admin->name  = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($admin->foto && Storage::disk('public')->exists('foto_admin/' . $admin->foto)) {
                Storage::disk('public')->delete('foto_admin/' . $admin->foto);
            }

            $filename = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->storeAs('foto_admin', $filename, 'public');

            $admin->foto = $filename;
        }

        $admin->save();

        return back()->with('success', 'Profil admin berhasil diperbarui!');
    }

    public function hapusFoto()
    {
        $admin = Auth::user();

        if ($admin->foto && Storage::disk('public')->exists('foto_admin/' . $admin->foto)) {
            Storage::disk('public')->delete('foto_admin/' . $admin->foto);
        }

        // reset ke default
        $admin->foto = null;
        $admin->save();

        return back()->with('success', 'Foto profil admin berhasil dihapus.');
    }


}
