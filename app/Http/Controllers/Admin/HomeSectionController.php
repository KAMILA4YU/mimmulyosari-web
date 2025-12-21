<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use App\Models\PpdbInfo;

class HomeSectionController extends Controller
{
    public function edit()
    {
        $home = HomeSection::first();
        if (!$home) {
            $home = HomeSection::create([]);
        }

        $ppdbInfo = PpdbInfo::latest()->first();

        return view('admin.home-section', compact('home', 'ppdbInfo'));
    }

    public function update(Request $request)
    {
        $home = HomeSection::first();

        // Update data teks biasa
        $home->fill($request->except(['gambar_hero', 'gambar_sambutan']));

        // Upload gambar hero jika diupload
        if ($request->hasFile('gambar_hero')) {
            $path = $request->file('gambar_hero')->store('hero', 'public');
            $home->gambar_hero = $path;
        }

        // Upload gambar sambutan jika diupload
        if ($request->hasFile('gambar_sambutan')) {
            $path = $request->file('gambar_sambutan')->store('sambutan', 'public');
            $home->gambar_sambutan = $path;
        }

        $home->save();

       return redirect()
        ->route('admin.home-section.edit', ['tab' => $request->tab])
        ->with('success', 'Pengaturan beranda berhasil diperbarui!');

    }


}
