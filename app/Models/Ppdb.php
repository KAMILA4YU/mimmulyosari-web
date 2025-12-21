<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    use HasFactory;

    protected $table = 'ppdbs';

    protected $fillable = [
        'user_id',
        'kode_daftar',

        // Data pribadi
        'nama_lengkap',
        'nama_panggilan',
        'nik',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'agama',
        'kewarganegaraan',

        // Alamat
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',

        // Orang tua
        'nama_ayah',
        'nama_ibu',
        'no_hp_ayah',
        'no_hp_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',

        // Upload berkas
        'akta_kelahiran',
        'kartu_keluarga',
        'foto_siswa',
        'ijazah_tk',
        'piagam',
        'kartu_sosial',
        'surat_pindahan',

        'status_siswa',

        // Status
        'status',
    ];

    public function pesan()
    {
        return $this->hasMany(PpdbPesan::class)->latest();
    }

}
