<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoKontak extends Model
{
    protected $table = 'infokontak';

    protected $fillable = [
        'alamat',
        'email',
        'telepon',
        'website',
        'jam_operasional'
    ];
}
