<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbInfo extends Model
{
    use HasFactory;

    protected $table = 'ppdb_infos';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tahun_ajaran',
        'gelombang',
        'status',
        'aktif'
    ];
}
