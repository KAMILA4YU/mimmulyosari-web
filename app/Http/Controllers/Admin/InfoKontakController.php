<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoKontak;

class InfoKontakController extends Controller
{
    public function update(Request $request)
    {
        // Ambil record pertama, kalau belum ada, buat kosong
        $info = InfoKontak::first();

        if (!$info) {
            $info = InfoKontak::create([
                'alamat' => '',
                'telepon' => '',
                'email' => '',
                'website' => '',
                'jam_operasional' => '',
            ]);
        }

        // Update data
        $info->update([
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'website' => $request->website,
            'jam_operasional' => $request->jam_operasional,
        ]);

        return back()->with('success', 'Info kontak berhasil diperbarui!');
    }
}
