<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $table = 'home_sections';

    protected $fillable = [
        'judul_hero',
        'subjudul_hero',
        'slogan_hero',
        'gambar_hero',

        'judul_sambutan',
        'deskripsi_sambutan',
        'gambar_sambutan',

        'judul_tentang',
        'deskripsi_tentang',
        'gambar_tentang',

        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'whatsapp',

        'ppdb_status',
        'ppdb_periode',
        'ppdb_gelombang',
        'ppdb_keterangan',
    ];
}
