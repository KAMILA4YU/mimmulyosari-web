<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Mail;
use App\Mail\BalasanKontak;
use App\Models\InfoKontak;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $query = Kontak::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $kontaks = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $info = InfoKontak::first();

        return view('admin.kontak', compact('kontaks', 'info'));
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'subjek' => 'required',
            'pesan' => 'required',
        ]);

        Kontak::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'subjek' => $request->subjek,
            'pesan'  => $request->pesan,
            'status' => 'baru', 
        ]);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil ditambahkan');
    }

    public function edit(Kontak $kontak)
    {
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request, Kontak $kontak)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'subjek' => 'required',
            'pesan' => 'required',
        ]);

        $kontak->update($request->only([
            'nama',
            'email',
            'subjek',
            'pesan'
        ]));

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diupdate');
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();

        return redirect()
            ->route('admin.kontak.index', ['tab' => 'pesan'])
            ->with('success', 'Kontak berhasil dihapus');
    }

    public function reply(Request $request, $id)
{
    $kontak = Kontak::findOrFail($id);

    if ($kontak->status === 'baru') {
        $kontak->update(['status' => 'dibaca']);
    }

    return view('admin.kontak.reply', [
        'kontak' => $kontak,
        'tab' => $request->tab ?? 'pesan'
    ]);
}


    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required'
        ]);

        $kontak = Kontak::findOrFail($id);

        $kontak->balasan = $request->balasan;
        $kontak->status  = 'dibalas';
        $kontak->save();
        
        Mail::to($kontak->email)->send(new BalasanKontak(
            $kontak->nama,
            $kontak->subjek,
            $request->balasan
        ));

        return redirect()
            ->route('admin.kontak.index', ['tab' => 'pesan'])
            ->with('success', 'Balasan berhasil dikirim ke email pengirim!');

    }

}
