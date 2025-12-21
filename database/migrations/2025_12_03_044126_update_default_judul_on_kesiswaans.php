<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDefaultJudulOnKesiswaans extends Migration
{
    public function up()
    {
        Schema::table('kesiswaans', function (Blueprint $table) {
            $table->string('judul')->default('')->change();
        });
    }

    public function down()
    {
        Schema::table('kesiswaans', function (Blueprint $table) {
            $table->string('judul')->default(null)->change();
        });
    }
}
