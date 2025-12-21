<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ppdb;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PpdbPesan;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = Ppdb::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $pendaftar = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.ppdb.daftar', compact('pendaftar'));
    }


    public function detail($id)
    {
        $pendaftar = Ppdb::findOrFail($id);
        return view('admin.ppdb.detail', compact('pendaftar'));
    }

    public function berkas(Request $request)
    {
        $query = Ppdb::query();

        $query->where('status', 'diterima');

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $pendaftar = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.ppdb.berkas', compact('pendaftar'));
    }


    public function verifikasi($id)
{
    $pendaftar = Ppdb::findOrFail($id);

    if ($pendaftar->status !== 'pending') {
        return back()->with('error', 'Hanya status PENDING yang bisa diverifikasi.');
    }

    $pendaftar->update(['status' => 'diterima']);

    return back()->with('success', 'Pendaftar berhasil diverifikasi.');
}

    public function tolak($id)
{
    $pendaftar = Ppdb::findOrFail($id);

    if ($pendaftar->status !== 'pending') {
        return back()->with('error', 'Hanya status PENDING yang bisa ditolak.');
    }

    $pendaftar->update(['status' => 'ditolak']);

    return back()->with('success', 'Pendaftar berhasil ditolak.');
}


    public function undo($id)
{
    $pendaftar = Ppdb::findOrFail($id);

    if (!in_array($pendaftar->status, ['diterima','ditolak'])) {
        return back()->with('error', 'Status tidak dapat di-undo.');
    }

    $pendaftar->update(['status' => 'pending']);

    return back()->with('success', 'Status dikembalikan ke Pending.');
}


    public function cetak($id)
    {
        $data = Ppdb::findOrFail($id);

        $pdf = Pdf::loadView('admin.ppdb.cetak-pdf', compact('data'))
                ->setPaper('A4', 'portrait');

        return $pdf->download(
            'Berkas_Pendaftar_'.$data->nama_lengkap.'.pdf'
        );
    }

    public function cetakSemua(Request $request)
{
    $query = Ppdb::query();

    if ($request->filled('bulan')) {
        $query->whereMonth('created_at', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('created_at', $request->tahun);
    }

    $pendaftar = $query->latest()->get();

    $pdf = Pdf::loadView('admin.ppdb.cetak-semua-pdf', compact('pendaftar'))
            ->setPaper('A4', 'landscape');

    return $pdf->download(
        'Berkas_Pendaftar_PPDB_' .
        ($request->tahun ?? 'Semua_Tahun') . '.pdf'
    );
}


    public function preview($id)
    {
        $data = Ppdb::findOrFail($id);

        $pdf = Pdf::loadView('admin.ppdb.cetak-pdf', compact('data'))
                ->setPaper('A4', 'portrait');

        return $pdf->stream(
            'Preview_Berkas_'.$data->nama_lengkap.'.pdf'
        );
    }

    public function kirimPesan(Request $request, $id)
{
    $request->validate([
        'pesan' => 'required'
    ]);

    $ppdb = Ppdb::findOrFail($id);

    PpdbPesan::create([
        'ppdb_id' => $ppdb->id,
        'pesan'   => $request->pesan,
        'is_read' => false, 
    ]);

    // hanya balikin ke pending kalau sebelumnya DITERIMA
    if ($ppdb->status === 'diterima') {
        $ppdb->update(['status' => 'pending']);
    }

    return back()->with('success', 'Pesan perbaikan berhasil dikirim.');
}


}
