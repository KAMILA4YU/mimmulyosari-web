<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        session([
            'active_tab' => $request->tab ?? (
                $request->filled('search') || $request->filled('kelas')
                    ? 'siswa'
                    : 'guru'
            )
        ]);

        $siswas = Siswa::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->where('nama_lengkap', 'like', "%{$request->search}%")
                    ->orWhere('nisn', 'like', "%{$request->search}%");
                });
            })

            ->when($request->kelas, fn ($q) => $q->where('kelas', $request->kelas))
            ->orderBy('nama_lengkap')
            ->paginate(10)
            ->withQueryString();

        $gurus = \App\Models\Guru::all();
        $totalSiswa = Siswa::count();

        return view('admin.guru-siswa.index', compact('siswas', 'gurus', 'totalSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'nisn' => 'required|string|unique:siswas,nisn',
            'kelas' => 'nullable|string',
            'nama_ortu' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        Siswa::create($request->all());

        return redirect()
        ->route('admin.siswa.index', ['tab' => 'siswa'])
        ->with('success', 'Siswa berhasil ditambahkan!');

    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string',
            'nisn' => 'required|string|unique:siswas,nisn,' . $id,
            'kelas' => 'nullable|string',
            'nama_ortu' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $siswa->update($request->all());

        return redirect()
            ->route('admin.siswa.index', ['tab' => 'siswa'])
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        Siswa::findOrFail($id)->delete();

        return redirect()
            ->route('admin.siswa.index', ['tab' => 'siswa'])
            ->with('success', 'Siswa berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()
            ->route('admin.siswa.index', ['tab' => 'siswa'])
            ->with([
                'success' => 'Data siswa berhasil diimport',
                'active_tab' => 'siswa'
            ]);
    }
    
}
