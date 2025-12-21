<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();

            // Bagian Hero di Beranda
            $table->string('judul_hero')->nullable();          
            $table->string('subjudul_hero')->nullable();       
            $table->text('slogan_hero')->nullable();           
            $table->string('gambar_hero')->nullable();         

            // Bagian Sambutan / Kabar Terkini
            $table->string('judul_sambutan')->nullable();      
            $table->text('deskripsi_sambutan')->nullable();    
            $table->string('gambar_sambutan')->nullable();     

            // Bagian Tentang Kami
            $table->string('judul_tentang')->nullable();       
            $table->text('deskripsi_tentang')->nullable();     
            $table->string('gambar_tentang')->nullable();      

            // Media Sosial
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whatsapp')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};
