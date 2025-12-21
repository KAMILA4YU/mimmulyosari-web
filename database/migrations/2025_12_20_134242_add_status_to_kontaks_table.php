<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->enum('status', ['baru', 'dibaca', 'dibalas'])
                  ->default('baru')
                  ->after('pesan');
        });
    }

    public function down(): void
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};