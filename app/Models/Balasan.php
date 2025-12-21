<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    use HasFactory;

    protected $fillable = ['pengaduan_id', 'admin_id', 'isi'];

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function pengaduan() {
        return $this->belongsTo(Pengaduan::class);
    }
}
