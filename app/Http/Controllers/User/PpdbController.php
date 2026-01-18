<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ppdb;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use Illuminate\Support\Facades\Storage;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use App\Models\PpdbPesan;


class PpdbController extends Controller
{
    // Tampilkan form
    public function form()
    {
        $existing = Ppdb::where('user_id', Auth::id())->first();
        if ($existing) {
            return redirect()->route('user.ppdb.hasil');
        }

        return view('user.ppdb.form');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
    'nama_lengkap' => 'required',

    'nik' => 'required|digits:16|unique:ppdbs,nik',

    'tempat_lahir' => 'required',
    'tanggal_lahir'=> 'required',
    'jenis_kelamin'=> 'required',
    'alamat'       => 'required',

    'status_siswa' => 'required|in:baru,pindahan',

    // WAJIB
    'akta_kelahiran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:25600',
    'kartu_keluarga' => 'required|file|mimes:jpg,jpeg,png,pdf|max:25600',
    'foto_siswa'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:25600',
    'ijazah_tk'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:25600',

    // OPSIONAL
    'piagam'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:25600',
    'kartu_sosial'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:25600',

    // KONDISIONAL
    'surat_pindahan' => 'required_if:status_siswa,pindahan|file|mimes:jpg,jpeg,png,pdf|max:25600',

    // NIK
    ], [
    'nik.required' => 'NIK wajib diisi.',
    'nik.digits'  => 'NIK harus terdiri dari 16 digit.',
    'nik.unique'  => 'NIK sudah terdaftar. Silakan gunakan NIK lain atau hubungi admin.',
]);

        // Upload helper
        $upload = fn($file, $folder) => $file?->store("ppdb/$folder", 'public');

        Ppdb::create([
            'user_id'        => Auth::id(),
            'kode_daftar' => 'PPDB-' . strtoupper(uniqid()),
            'status_siswa' => $request->status_siswa,

            // Data siswa
            'nama_lengkap'   => $request->nama_lengkap,
            'nama_panggilan' => $request->nama_panggilan,
            'nik'            => $request->nik,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'agama'          => $request->agama,
            'kewarganegaraan'=> $request->kewarganegaraan,
            'alamat'         => $request->alamat,
            'desa'           => $request->desa,
            'kecamatan'      => $request->kecamatan,
            'kabupaten'      => $request->kabupaten,
            'provinsi'       => $request->provinsi,
            'kode_pos'       => $request->kode_pos,

            // Orang tua
            'nama_ayah'      => $request->nama_ayah,
            'nama_ibu'       => $request->nama_ibu,
            'no_hp_ayah'     => $request->no_hp_ayah,
            'no_hp_ibu'      => $request->no_hp_ibu,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pekerjaan_ibu'  => $request->pekerjaan_ibu,

            // Upload
            'akta_kelahiran' => $upload($request->akta_kelahiran, 'akta'),
            'kartu_keluarga' => $upload($request->kartu_keluarga, 'kk'),
            'foto_siswa'     => $upload($request->foto_siswa, 'foto'),
            'ijazah_tk'      => $upload($request->ijazah_tk, 'ijazah'),
            'piagam' => $request->hasFile('piagam')
                ? $upload($request->piagam, 'piagam')
                : null,

            'kartu_sosial' => $request->hasFile('kartu_sosial')
                ? $upload($request->kartu_sosial, 'kartu_sosial')
                : null,

            'surat_pindahan' => $request->hasFile('surat_pindahan')
                ? $upload($request->surat_pindahan, 'surat_pindahan')
                : null,

            'status' => 'pending',
        ]);

        return redirect()->route('user.ppdb.hasil')->with('success', 'Pendaftaran berhasil dikirim!');
    }

    // Halaman hasil
    public function hasil()
    {
        $ppdb = Ppdb::where('user_id', Auth::id())->first();
        return view('user.ppdb.hasil', compact('ppdb'));
    }


    public function markPesanRead($id)
    {
        $pesan = PpdbPesan::findOrFail($id);

        // pengaman (opsional tapi disarankan)
        if ($pesan->ppdb->user_id !== auth()->id()) {
            abort(403);
        }

        $pesan->update([
            'is_read' => true
        ]);

        return back()->with('success', 'Pesan berhasil ditandai sudah diperbarui.');
    }


    public function uploadUlang(Request $request)
    {
        $request->validate([
            'field' => 'required',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:25600'
        ]);

        $ppdb = Ppdb::where('user_id', Auth::id())->first();

        if (!$ppdb) {
            return back()->with('error', 'Data PPDB tidak ditemukan');
        }

        // hapus file lama (PAKAI DISK PUBLIC)
        if ($ppdb->{$request->field}) {
            Storage::disk('public')->delete($ppdb->{$request->field});
        }

        // upload baru (PAKAI DISK PUBLIC)
        $path = $request->file('file')->store('ppdb', 'public');

        // update kolom lama
        $ppdb->update([
            $request->field => $path
        ]);

        return back()->with('success', 'Berkas berhasil diperbarui');
    }

    public function cetak()
    {
        $ppdb = Ppdb::where('user_id', Auth::id())->firstOrFail();

        if ($ppdb->status !== 'diterima') {
            abort(403, 'Bukti PPDB hanya dapat dicetak setelah pendaftaran diterima.');
        }

        // generate svg
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrSvg = $writer->writeString($ppdb->kode_daftar);

        // simpan ke storage
        $fileName = 'qr-' . $ppdb->kode_daftar . '.svg';
        Storage::disk('public')->put('qrcode/' . $fileName, $qrSvg);

        $qrPath = public_path('storage/qrcode/' . $fileName);

        $pdf = PDF::loadView('user.ppdb.cetak', [
            'ppdb' => $ppdb,
            'qrPath' => $qrPath
        ]);

        return $pdf->stream('Bukti-PPDB.pdf');
    }


}
