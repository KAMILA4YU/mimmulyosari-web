<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProfilSekolahController as AdminProfilSekolahController;
use App\Http\Controllers\Admin\KesiswaanController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController; 
use App\Http\Controllers\KontakController; 
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\PublicPpdbController;
use App\Http\Controllers\User\PpdbController as UserPpdbController;
use App\Http\Controllers\ProfilSekolahController as PublicProfilSekolahController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\KesiswaanPublicController;
use App\Http\Controllers\BeritaPublicController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\ArtikelPublicController;
use App\Http\Controllers\KontakPublicController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\InfoKontakController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\User\PengaduanController as UserPengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;


// Veirifkasi Email
    // Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['auth', 'signed'])
    //     ->name('verification.verify');
        
    // Route::get('/email/verify', function () {
    //     return view('auth.verify-email');
    // })->middleware('auth')->name('verification.notice');

    // Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    //     $request->user()->sendEmailVerificationNotification();
    //     return back()->with('message', 'Link verifikasi telah dikirim ulang.');
    // })->middleware(['auth', 'throttle:6,1'])
    // ->name('verification.send');


// 🔹 Halaman utama & umum
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-sekolah', [PublicProfilSekolahController::class, 'index'])
    ->name('profil.sekolah');

Route::get('/kesiswaan', [KesiswaanPublicController::class, 'index'])->name('kesiswaan');

Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');

Route::get('/berita', [BeritaPublicController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaPublicController::class, 'show'])->name('berita.show');

Route::get('/artikel', [ArtikelPublicController::class, 'index'])->name('artikel');
Route::get('/artikel/{id}', [ArtikelPublicController::class, 'show'])->name('artikel.show');

Route::get('/galeri', [GaleriController::class, 'showPublic'])->name('galeri');

// 🔹 Kontak umum
Route::get('/kontak', [KontakPublicController::class, 'index'])->name('kontak.index');
Route::post('/kontak/kirim', [KontakPublicController::class, 'store'])->name('kontak.kirim');

// 🔹 Artikel umum
Route::get('/artikel', [ArtikelController::class, 'showPublic'])->name('artikel');
Route::get('/artikel/{id}', [ArtikelController::class, 'showDetail'])->name('artikel.show');

// 🔹 PPDB umum
Route::get('/ppdb', [PublicPpdbController::class, 'index'])->name('ppdb.index');

// PPDB login wajib (dashboard user)
Route::middleware(['auth'])->group(function () {
    Route::get('/ppdb/daftar', [UserPpdbController::class, 'form'])->name('ppdb.form');
    Route::post('/ppdb/daftar', [UserPpdbController::class, 'store'])->name('ppdb.store');
});


// 🔹 Dashboard & User area
Route::middleware(['auth', 'verified'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

    // Dashboard User
    // Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
    Route::get('/dashboard', function () {return view('user.dashboard');})->name('dashboard');

    // Profil
    Route::get('/profil', [UserController::class, 'profil'])
        ->name('profil');
    Route::post('/profil/update', [UserController::class, 'updateProfil'])
        ->name('profil.update');
    Route::delete('profil/hapus-foto', [UserController::class, 'hapusFoto'])->name('profil.hapus-foto');

    // User PPDB
    Route::prefix('ppdb')->name('ppdb.')->group(function () {

        // Tampil form
        Route::get('/daftar', [UserPpdbController::class, 'form'])->name('form');

        // Simpan form
        Route::post('/daftar', [UserPpdbController::class, 'store'])->name('store');

        // Halaman hasil
        Route::get('/hasil', [UserPpdbController::class, 'hasil'])->name('hasil');

        // Tandai pesan admin sudah dibaca
        Route::patch('/pesan/{id}/read', [UserPpdbController::class, 'markPesanRead'])
            ->name('pesan.read');

        Route::put('/update-berkas/{field}', [UserPpdbController::class, 'updateBerkas'])->name('updateBerkas');
        Route::post('/upload-ulang', [UserPpdbController::class, 'uploadUlang'])
            ->name('uploadUlang');

        // Cetak bukti PPDB
        Route::get('/cetak', [UserPpdbController::class, 'cetak'])->name('cetak');

    });

    // 🔹 Pengaduan USER
    Route::get('pengaduan', [UserPengaduanController::class, 'index'])
        ->name('pengaduan.index');

    Route::get('pengaduan/create', [UserPengaduanController::class, 'create'])
        ->name('pengaduan.create');

    Route::post('pengaduan', [UserPengaduanController::class, 'store'])
        ->name('pengaduan.store');

    // 🔹 Detail 1 Pengaduan + Balasan Admin
    Route::get('pengaduan/{pengaduan}', [UserPengaduanController::class, 'show'])
        ->name('pengaduan.show');

});

Route::get('/test-qr-svg', function () {
    $renderer = new ImageRenderer(
        new RendererStyle(200),
        new SvgImageBackEnd()
    );

    $writer = new Writer($renderer);

    return response(
        $writer->writeString('TEST QR MI')
    )->header('Content-Type', 'image/svg+xml');
});

// 🔹 Dashboard Admin
Route::middleware(['auth','isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Profil Admin
        Route::get('/profil', [AdminController::class, 'profil'])
            ->name('profil');
        Route::post('/profil/update', [AdminController::class, 'updateProfil'])
            ->name('profil.update');
        Route::delete('/profil/hapus-foto', [AdminController::class, 'hapusFoto'])
            ->name('profil.hapus-foto');

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/ppdb', [AdminController::class, 'ppdb'])->name('ppdb');

        // Home Section
        Route::get('/home-section', [HomeSectionController::class, 'edit'])
            ->name('home-section.edit');

        Route::post('/home-section', [HomeSectionController::class, 'update'])
            ->name('home-section.update');


        // Profil Sekolah
        Route::get('/profil-sekolah', [AdminProfilSekolahController::class, 'index'])
            ->name('profil-sekolah');
        Route::post('/profil-sekolah', [AdminProfilSekolahController::class, 'update'])
            ->name('profil-sekolah.update');

        // GURU CRUD
        Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');
        Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');

        // Data Guru & Siswa
        Route::get('/guru-siswa', [AdminController::class, 'guruSiswa'])->name('guru-siswa');
        
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
        Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');

        // KESISWAAN CRUD
        Route::prefix('kesiswaan')->name('kesiswaan.')->group(function () {

            // Index
            Route::get('/', [KesiswaanController::class, 'index'])->name('index');

            // Store
            Route::post('/ekskul/store', [KesiswaanController::class, 'storeEkskul'])->name('ekskul.store');
            Route::post('/organisasi/store', [KesiswaanController::class, 'storeOrganisasi'])->name('organisasi.store');
            Route::post('/keagamaan/store', [KesiswaanController::class, 'storeKeagamaan'])->name('keagamaan.store');
            Route::post('/prestasi/store', [KesiswaanController::class, 'storePrestasi'])->name('prestasi.store');
            Route::post('/pembinaan/store', [KesiswaanController::class, 'storePembinaan'])->name('pembinaan.store');
            Route::post('/pengaturan/update', [KesiswaanController::class, 'updatePengaturan'])->name('pengaturan.update');

            // Update
            Route::put('/{id}', [KesiswaanController::class, 'update'])->name('update');

            // Delete
            Route::delete('/{id}', [KesiswaanController::class, 'destroy'])->name('destroy');
        });

        // Informasi CRUD
        Route::get('/informasi', [App\Http\Controllers\Admin\InformasiController::class, 'index'])->name('informasi');
        Route::post('/informasi', [App\Http\Controllers\Admin\InformasiController::class, 'store'])->name('informasi.store');
        Route::put('/informasi/{id}', [App\Http\Controllers\Admin\InformasiController::class, 'update'])->name('informasi.update');
        Route::delete('/informasi/{id}', [App\Http\Controllers\Admin\InformasiController::class, 'destroy'])->name('informasi.destroy');

        // Berita CRUD
        Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
        Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
        Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

        // Artikel CRUD 
        Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
        Route::post('/artikel/store', [ArtikelController::class, 'store'])->name('artikel.store');
        Route::put('/artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
        Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

        // Galeri CRUD
        Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
        Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
        Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

        // CRUD Kontak (Pesan Pengunjung)
        Route::resource('kontak', AdminKontakController::class);

        // Balasan Kontak
        Route::get('kontak/{id}/reply', [AdminKontakController::class, 'reply'])
            ->name('kontak.reply');
        Route::post('kontak/{id}/send-reply', [AdminKontakController::class, 'sendReply'])
            ->name('kontak.sendReply');

        // UPDATE INFO KONTAK (TAB 1)
        Route::put('/info-kontak', [InfoKontakController::class, 'update'])
            ->name('info-kontak.update');

        // Pengaduan CRUD & Balasan
        Route::get('pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('pengaduan/{pengaduan}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::put('pengaduan/{pengaduan}', [AdminPengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('pengaduan/{pengaduan}', [AdminPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
        Route::post('pengaduan/{pengaduan}/balas', [AdminPengaduanController::class, 'balas'])->name('pengaduan.balas');

        // PPDB 
        Route::prefix('ppdb')->name('ppdb.')->group(function () {

            // TABEL PENDAFTAR
            Route::get('/pendaftar', [App\Http\Controllers\Admin\PpdbController::class, 'index'])
                ->name('pendaftar');

            // DETAIL PENDAFTAR
            Route::get('/detail/{id}', [App\Http\Controllers\Admin\PpdbController::class, 'detail'])
                ->name('detail');

            // BERKAS PENDAFTAR
            Route::get('/berkas', [App\Http\Controllers\Admin\PpdbController::class, 'berkas'])
                ->name('berkas');

            // VERIFIKASI & TOLAK PENDAFTAR
            Route::post('/verifikasi/{id}', [App\Http\Controllers\Admin\PpdbController::class, 'verifikasi'])
                ->name('verifikasi');
            Route::post('/tolak/{id}', [App\Http\Controllers\Admin\PpdbController::class, 'tolak'])
                ->name('tolak');
            Route::post('/undo/{id}', [App\Http\Controllers\Admin\PpdbController::class, 'undo'])
                ->name('undo');

            // CETAK PDF PENDAFTAR
            Route::get('/cetak/{id}', [App\Http\Controllers\Admin\PpdbController::class, 'cetak'])
                ->name('cetak');

            // PREVIEW PDF
            Route::get('/preview/{id}', [App\Http\Controllers\Admin\PpdbController::class, 'preview'])
                ->name('preview');

            // CETAK SEMUA PENDAFTAR
            Route::get('/cetak-semua', [App\Http\Controllers\Admin\PpdbController::class, 'cetakSemua'])
                ->name('cetak-semua');
            
            Route::post('/pesan/{id}', [App\Http\Controllers\Admin\PpdbController::class, 'kirimPesan'])
                ->name('pesan');

        });

    });

require __DIR__ . '/auth.php';
