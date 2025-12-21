<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->enum('ppdb_status', ['dibuka', 'ditutup'])->default('ditutup');
            $table->string('ppdb_periode')->nullable();
            $table->string('ppdb_gelombang')->nullable();
            $table->text('ppdb_keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn([
                'ppdb_status',
                'ppdb_periode',
                'ppdb_gelombang',
                'ppdb_keterangan',
            ]);
        });
    }

};
