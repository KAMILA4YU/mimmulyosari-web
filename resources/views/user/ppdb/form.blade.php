@extends('layouts.user')

@section('title', 'Form PPDB')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4 text-primary">Formulir PPDB MI Muhammadiyah Mulyosari</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('user.ppdb.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf

        <h4 class="fw-semibold mt-4">
            <i class="bi bi-mortarboard me-2"></i> Data Calon Siswa
        </h4>


        <div class="col-md-6">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Nama Panggilan</label>
            <input type="text" name="nama_panggilan" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Agama</label>
            <input type="text" name="agama" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" value="Indonesia" class="form-control">
        </div>

        <div class="col-md-8">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2" required></textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label">Desa</label>
            <input type="text" name="desa" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Kabupaten</label>
            <input type="text" name="kabupaten" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Provinsi</label>
            <input type="text" name="provinsi" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control">
        </div>

        <hr class="my-4">

        <h4 class="fw-semibold">
            <i class="bi bi-people-fill me-2"></i> Data Orang Tua / Wali
        </h4>

        <div class="col-md-6">
            <label class="form-label">Nama Ayah</label>
            <input type="text" name="nama_ayah" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Pekerjaan Ayah</label>
            <input type="text" name="pekerjaan_ayah" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Nama Ibu</label>
            <input type="text" name="nama_ibu" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Pekerjaan Ibu</label>
            <input type="text" name="pekerjaan_ibu" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">No HP Ayah</label>
            <input type="text" name="no_hp_ayah" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">No HP Ibu</label>
            <input type="text" name="no_hp_ibu" class="form-control">
        </div>

        <hr class="my-4">

        <h4 class="fw-semibold">
            <i class="bi bi-file-earmark-arrow-up me-2"></i> Upload Berkas Persyaratan
        </h4>
        
        <div class="col-md-4">
            <label class="form-label">Status Siswa</label>
            <select name="status_siswa" id="status_siswa" class="form-control" required>
                <option value="baru">Siswa Baru</option>
                <option value="pindahan">Siswa Pindahan</option>
            </select>
        </div>

        <div class="alert alert-warning mt-3">
            <strong>Catatan:</strong><br>
            Harap menyiapkan <b>fotocopy berkas persyaratan (hardfile)</b> untuk keperluan verifikasi secara langsung.
            Berkas fotocopy dibawa dan diserahkan ke <b>MI Muhammadiyah Mulyosari</b>.
        </div>

        <p class="text-muted">*Format file: JPG/PNG/PDF — max 25MB</p>

        <div class="col-md-4">
            <label class="form-label">FC Akta Kelahiran</label>
            <input type="file" class="form-control" name="akta_kelahiran" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">FC Kartu Keluarga</label>
            <input type="file" class="form-control" name="kartu_keluarga" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Pas Foto Siswa</label>
                <small class="text-muted d-block mb-1">
                Ukuran 3&times;4 • Seragam TK/RA • Latar merah
                </small>
            <input type="file" class="form-control" name="foto_siswa" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">FC Ijazah TK</label>
            <input type="file" class="form-control" name="ijazah_tk">
        </div>

        <div class="col-md-4 d-none" id="surat_pindahan_wrapper">
            <label class="form-label">Surat Pindahan (Khusus Siswa Pindahan)</label>
            <input type="file" class="form-control" name="surat_pindahan">
        </div>

        <div class="col-md-4">
            <label class="form-label">Piagam (opsional)</label>
            <input type="file" class="form-control" name="piagam">
        </div>

        <div class="col-md-4">
            <label class="form-label">FC Kartu Sosial (KIS/PKH/KKS) (opsional)</label>
            <input type="file" class="form-control" name="kartu_sosial">
        </div>

        <hr class="my-4">

        <button class="btn btn-primary px-4 py-2 fw-bold">Kirim Pendaftaran</button>
    </form>
</div>
<script>
    document.getElementById('status_siswa').addEventListener('change', function () {
        const suratPindahan = document.getElementById('surat_pindahan_wrapper');

        if (this.value === 'pindahan') {
            suratPindahan.classList.remove('d-none');
        } else {
            suratPindahan.classList.add('d-none');
        }
    });
</script>

@endsection
