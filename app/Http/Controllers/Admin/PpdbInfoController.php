<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbInfo;

class PpdbInfoController extends Controller
{
    /**
     * Ambil PPDB aktif (dipakai di frontend)
     */
    public static function getActive()
    {
        return PpdbInfo::where('aktif', true)
            ->orderByDesc('created_at')
            ->first();
    }

    /**
     * Halaman admin PPDB Info
     */
    public function index()
    {
        $ppdbInfo = PpdbInfo::first();
        return view('admin.ppdb-info.index', compact('ppdbInfo'));
    }

    /**
     * Simpan / update info PPDB
     */
    public function store(Request $request)
{
    dd($request->all());
    
    $request->validate([
        'status'     => 'required',
        'periode'    => 'nullable|string',
        'gelombang'  => 'nullable|string',
        'keterangan' => 'nullable|string',
    ]);

    PpdbInfo::updateOrCreate(
        ['id' => 1],
        [
            'judul'         => 'Informasi PPDB',
            'tahun_ajaran'  => $request->periode,
            'gelombang'     => $request->gelombang,
            'deskripsi'     => $request->keterangan,
            'status'        => $request->status,
            'aktif'         => $request->status === 'dibuka',
        ]
    );

    return back()->with('success', 'Informasi PPDB berhasil disimpan.');
}

}
