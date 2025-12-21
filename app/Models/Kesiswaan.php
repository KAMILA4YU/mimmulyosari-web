<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kesiswaan extends Model
{
    protected $fillable = [
        'nama',
        'judul',
        'deskripsi',
        'kategori',
        'pembimbing',
        'gambar',  
    ];
}
