<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'required' => 'Kolom :attribute wajib diisi.',
    'required_if' => 'Kolom :attribute wajib diisi.',
    'string' => 'Kolom :attribute harus berupa teks.',
    'numeric' => 'Kolom :attribute harus berupa angka.',

    'min' => [
        'string' => 'Kolom :attribute minimal :min karakter.',
        'file'   => 'Ukuran :attribute minimal :min KB.',
    ],

    'max' => [
        'string' => 'Kolom :attribute maksimal :max karakter.',
        'file'   => 'Ukuran :attribute maksimal :max KB.',
    ],

    'mimes' => 'Format file :attribute harus berupa: :values.',

    'in' => 'Nilai :attribute tidak valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'password' => 'password',
        'password_confirmation' => 'konfirmasi password',

        // PPDB
        'foto_siswa' => 'Foto Siswa',
        'akta_kelahiran' => 'Akta Kelahiran',
        'kartu_keluarga' => 'Kartu Keluarga',
        'ijazah_tk' => 'Ijazah TK',
        'surat_pindahan' => 'Surat Pindahan',
        'piagam' => 'Piagam',
        'kartu_sosial' => 'Kartu Sosial',
    ],

];
