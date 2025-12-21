<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SiswaImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function uniqueBy()
    {
        return 'nisn';
    }

    public function model(array $row)
    {
        if (
            empty($row['nama_lengkap']) ||
            empty($row['nisn'])
        ) {
            return null;
        }

        return new Siswa([
            'nama_lengkap' => trim($row['nama_lengkap']),
            'nisn'         => trim($row['nisn']),
            'kelas'        => $row['kelas'] ?? null,
            'nama_ortu'    => $row['nama_ortu'] ?? null,
            'no_hp'        => $row['no_hp'] ?? null,
        ]);
    }

}
