<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kesiswaans', function (Blueprint $table) {
            $table->string('kategori')->default('ekskul');
            $table->string('nama')->nullable();
            $table->string('pembimbing')->nullable();
        });
    }

    public function down()
    {
        Schema::table('kesiswaans', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'nama', 'pembimbing']);
        });
    }

};
