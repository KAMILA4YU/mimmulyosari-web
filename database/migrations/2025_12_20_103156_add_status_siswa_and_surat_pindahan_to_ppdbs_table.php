<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppdbs', function (Blueprint $table) {

            // Status siswa (baru / pindahan)
            $table->enum('status_siswa', ['baru', 'pindahan'])
                  ->default('baru')
                  ->after('user_id');

            // Surat pindahan (khusus siswa pindahan)
            $table->string('surat_pindahan')
                  ->nullable()
                  ->after('ijazah_tk');
        });
    }

    public function down(): void
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->dropColumn(['status_siswa', 'surat_pindahan']);
        });
    }
};
