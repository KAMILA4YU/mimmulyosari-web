<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\View;
use App\Models\HomeSection;
use Illuminate\Pagination\Paginator;
use App\Models\Ppdb;
use App\Models\Kontak;
use App\Models\Pengaduan;
use App\Models\PpdbPesan;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Paksa GD backend untuk Simple-QrCode
        $this->app->bind(Generator::class, function () {
            return new Generator('gd');
        });
    }

    public function boot(): void
    {
        Carbon::setLocale('id');
        View::share('profilSekolah', ProfilSekolah::first());
        View::share('homeSection', HomeSection::first());
        
        // Notif Sidebar Admin
        View::composer('layouts.admin', function ($view) {

            $ppdbCount = Ppdb::where('status', 'pending')->count();

            $kontakCount = Kontak::where('status', 'baru')->count();

            $pengaduanCount = Pengaduan::where('status', 'Menunggu')->count();

            $view->with([
                'notifPpdb'      => min($ppdbCount, 10),
                'notifKontak'    => min($kontakCount, 10),
                'notifPengaduan' => min($pengaduanCount, 10),
            ]);
        });

        // Notif Sidebar User
        View::composer('layouts.user', function ($view) {

            $notifPesanUser = 0;

            if (Auth::check()) {
                $notifPesanUser = PpdbPesan::whereHas('ppdb', function ($q) {
                        $q->where('user_id', Auth::id());
                    })
                    ->where('is_read', false)
                    ->count();
            }

            $view->with('notifPesanUser', $notifPesanUser);
        });

        Paginator::useBootstrapFive();
    }
}
