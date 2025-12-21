<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profil()
    {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }

public function updateProfil(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'foto' => 'nullable|image|max:5120',
    ]);

    $user = Auth::user();

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('foto')) {

        // hapus foto lama
        if ($user->foto && file_exists(public_path('foto_user/' . $user->foto))) {
            unlink(public_path('foto_user/' . $user->foto));
        }

        $filename = time() . '_' . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('foto_user'), $filename);

        $user->foto = $filename;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return back()->with('success', 'Profil berhasil diperbarui!');
}

public function hapusFoto()
{
    $user = Auth::user();

    if ($user->foto && file_exists(public_path('foto_user/' . $user->foto))) {
        unlink(public_path('foto_user/' . $user->foto));
    }

    // reset ke null
    $user->foto = null;
    $user->save();

    return back()->with('success', 'Foto profil berhasil dihapus.');
}


}
