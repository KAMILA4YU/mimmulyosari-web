<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->string('kode_daftar')->unique()->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->dropColumn('kode_daftar');
        });
    }

};
