<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
    ];

    public function getFotoUrlAttribute()
    {
        // Jika foto ada dan file-nya memang ada di storage
        if ($this->foto && file_exists(storage_path('app/public/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }

        // Jika tidak ada → gunakan default
        return asset('storage/guru/default-guru.jpg');
    }


}
