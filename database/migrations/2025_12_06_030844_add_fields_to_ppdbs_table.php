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
        Schema::table('ppdbs', function (Blueprint $table) {

            // Relasi user
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // Data pribadi siswa
            $table->string('nama_lengkap')->nullable();
            $table->string('nama_panggilan')->nullable();
            $table->string('nik')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('agama')->nullable();
            $table->string('kewarganegaraan')->default('Indonesia');

            // Data alamat
            $table->text('alamat')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();

            // Data orang tua / wali
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('no_hp_ayah')->nullable();
            $table->string('no_hp_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();

            // Upload berkas sesuai syarat PPDB
            $table->string('akta_kelahiran')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('foto_siswa')->nullable();
            $table->string('ijazah_tk')->nullable();
            $table->string('piagam')->nullable();
            $table->string('kartu_sosial')->nullable(); // KIS/PKH/KKS

            // Status pendaftaran
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'nama_lengkap',
                'nama_panggilan',
                'nik',
                'tanggal_lahir',
                'tempat_lahir',
                'jenis_kelamin',
                'agama',
                'kewarganegaraan',
                'alamat',
                'desa',
                'kecamatan',
                'kabupaten',
                'provinsi',
                'kode_pos',
                'nama_ayah',
                'nama_ibu',
                'no_hp_ayah',
                'no_hp_ibu',
                'pekerjaan_ayah',
                'pekerjaan_ibu',
                'akta_kelahiran',
                'kartu_keluarga',
                'foto_siswa',
                'ijazah_tk',
                'piagam',
                'kartu_sosial',
                'status',
            ]);
        });
    }
};
