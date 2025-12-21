<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbPesan extends Model
{
    protected $table = 'ppdb_pesan';
    protected $fillable = ['ppdb_id', 'pesan', 'is_read'];

    public function ppdb()
    {
        return $this->belongsTo(Ppdb::class);
    }
}

