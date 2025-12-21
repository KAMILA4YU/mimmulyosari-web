<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|max:25600'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru = Guru::create($data);

        return response()->json([
            'success' => true,
            'data' => $guru
        ]);
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $guru->nama = $request->nama;
        $guru->jabatan = $request->jabatan;

        if ($request->hasFile('foto')) {
            $guru->foto = $request->file('foto')->store('guru', 'public');
        }

        $guru->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Guru::destroy($id);

        return response()->json(['success' => true]);
    }

}
