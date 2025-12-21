@extends('layouts.admin')

@section('content')
<div class="container">

    {{--   JUDUL HALAMAN   --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0">
            Cetak Berkas Pendaftar
        </h4>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="fw-bold mb-3">{{ $data->nama_lengkap }}</h5>

            <p><strong>NIK:</strong> {{ $data->nik }}</p>
            <p><strong>Status:</strong> {{ ucfirst($data->status) }}</p>

            <hr>

            <h6 class="fw-bold mt-3">Daftar Berkas:</h6>

            <ul>
                <li>Akta: {{ $data->akta_kelahiran ? 'Ada' : 'Tidak ada' }}</li>
                <li>KK: {{ $data->kartu_keluarga ? 'Ada' : 'Tidak ada' }}</li>
                <li>Foto: {{ $data->foto_siswa ? 'Ada' : 'Tidak ada' }}</li>
                <li>Ijazah TK: {{ $data->ijazah_tk ? 'Ada' : 'Tidak ada' }}</li>
                <li>Piagam: {{ $data->piagam ? 'Ada' : 'Tidak ada' }}</li>
                <li>Kartu Sosial: {{ $data->kartu_sosial ? 'Ada' : 'Tidak ada' }}</li>
            </ul>

        </div>
    </div>

</div>
@endsection
