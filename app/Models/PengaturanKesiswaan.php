<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanKesiswaan extends Model
{
    protected $table = 'pengaturan_kesiswaans';

    protected $fillable = [
        'foto_header',
        'deskripsi',
    ];
}

