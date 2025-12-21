<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->string('npsn')->nullable();
            $table->string('tahun_berdiri')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('foto_sekolah')->nullable(); // untuk gambar sekolah
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            //
        });
    }
};
