@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    {{--   JUDUL HALAMAN   --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0">
            Detail Pendaftar PPDB
        </h4>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{--   CARD: DATA DIRI SISWA   --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 pb-2 border-bottom">Data Diri Siswa</h5>

            <div class="col-md-6 mt-3">
                <strong>Status Siswa:</strong><br>

                @if($pendaftar->status_siswa === 'pindahan')
                    <span class="status-badge pindahan">
                        <i class="bi bi-arrow-left-right me-1"></i> Siswa Pindahan
                    </span>
                @else
                    <span class="status-badge baru">
                        <i class="bi bi-person-plus-fill me-1"></i> Siswa Baru
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <strong>Nama Lengkap:</strong><br>
                    {{ $pendaftar->nama_lengkap }}
                </div>

                <div class="col-md-6 mb-2">
                    <strong>NIK:</strong><br>
                    {{ $pendaftar->nik }}
                </div>

                <div class="col-md-6 mt-3">
                    <strong>Status Pendaftaran:</strong><br>
                    <span class="badge px-3 py-2 mt-1 
                        @if($pendaftar->status=='diterima') bg-success 
                        @elseif($pendaftar->status=='ditolak') bg-danger 
                        @else bg-warning text-dark @endif">
                        {{ ucfirst($pendaftar->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{--   CARD: DATA ORANG TUA   --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 pb-2 border-bottom">Data Orang Tua</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>Nama Ayah:</strong><br>
                    {{ $pendaftar->nama_ayah }}

                    <br><br>
                    <strong>No HP Ayah:</strong><br>
                    {{ $pendaftar->no_hp_ayah }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Nama Ibu:</strong><br>
                    {{ $pendaftar->nama_ibu }}

                    <br><br>
                    <strong>No HP Ibu:</strong><br>
                    {{ $pendaftar->no_hp_ibu }}
                </div>
            </div>
        </div>
    </div>

    {{--   CARD: DOKUMEN WAJIB   --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 pb-2 border-bottom">Dokumen Wajib</h5>

            <ul class="list-group list-group-flush">

                <li class="list-group-item px-0">
                    <strong>FC Akta Kelahiran:</strong><br>
                    @if($pendaftar->akta_kelahiran)
                        <!-- <a href="{{ asset('storage/'.$pendaftar->akta_kelahiran) }}"
                           target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3">
                            Lihat Dokumen
                        </a> -->
                        <button 
                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#dokumenModal"
                            data-title="Akta Kelahiran"
                            data-file="{{ asset('storage/'.$pendaftar->akta_kelahiran) }}">
                            Lihat Dokumen
                        </button>
                    @else
                        <span class="badge bg-danger mt-2">Belum Upload</span>
                    @endif
                </li>

                <li class="list-group-item px-0">
                    <strong>FC Kartu Keluarga:</strong><br>
                    @if($pendaftar->kartu_keluarga)
                        <!-- <a href="{{ asset('storage/'.$pendaftar->kartu_keluarga) }}"
                           target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3">
                            Lihat Dokumen
                        </a> -->
                        <button 
                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#dokumenModal"
                            data-title="Kartu Keluarga"
                            data-file="{{ asset('storage/'.$pendaftar->kartu_keluarga) }}">
                            Lihat Dokumen
                        </button>
                    @else
                        <span class="badge bg-danger mt-2">Belum Upload</span>
                    @endif
                </li>

                <li class="list-group-item px-0">
                    <strong>FC Ijazah TK/RA:</strong><br>
                    @if($pendaftar->ijazah_tk)
                        <!-- <a href="{{ asset('storage/'.$pendaftar->ijazah_tk) }}"
                           target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3">
                            Lihat Dokumen
                        </a> -->
                        <button 
                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#dokumenModal"
                            data-title="Ijazah TK"
                            data-file="{{ asset('storage/'.$pendaftar->ijazah_tk) }}">
                            Lihat Dokumen
                        </button>
                    @else
                        <span class="badge bg-warning text-dark mt-2">Opsional</span>
                    @endif
                </li>

                <!-- Surat Pindah Khusus Siswa Pindahan -->
                @if($pendaftar->status_siswa === 'pindahan')
                <li class="list-group-item px-0">
                    <strong>Surat Pindahan Sekolah:</strong><br>

                    @if($pendaftar->surat_pindahan)
                        <!-- <a href="{{ asset('storage/'.$pendaftar->surat_pindahan) }}"
                        target="_blank"
                        class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3">
                            Lihat Dokumen
                        </a> -->
                        <button 
                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#dokumenModal"
                            data-title="Surat Pindahan"
                            data-file="{{ asset('storage/'.$pendaftar->surat_pindahan) }}">
                            Lihat Dokumen
                        </button>
                    @else
                        <span class="badge bg-danger mt-2">
                            Wajib (Belum Upload)
                        </span>
                    @endif
                </li>
                @endif

                <li class="list-group-item px-0">
                    <strong>Pas Foto 3&times;4:</strong><br>
                    @if($pendaftar->foto_siswa)
                        <!-- <a href="{{ asset('storage/'.$pendaftar->foto_siswa) }}"
                           target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3">
                            Lihat Foto
                        </a> -->
                        <button 
                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#dokumenModal"
                            data-title="Pas Foto"
                            data-file="{{ asset('storage/'.$pendaftar->foto_siswa) }}">
                            Lihat Dokumen
                        </button>
                    @else
                        <span class="badge bg-danger mt-2">Belum Upload</span>
                    @endif
                </li>

            </ul>
        </div>
    </div>

    {{--   CARD: DOKUMEN PENDUKUNG   --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 pb-2 border-bottom">Dokumen Pendukung</h5>

            <ul class="list-group list-group-flush">

                <li class="list-group-item px-0">
                    <strong>Piagam / Sertifikat:</strong><br>
                    @if($pendaftar->piagam)
                        <!-- <a href="{{ asset('storage/'.$pendaftar->piagam) }}"
                           target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3">
                            Lihat Dokumen
                        </a> -->
                        <button 
                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#dokumenModal"
                            data-title="Piagam"
                            data-file="{{ asset('storage/'.$pendaftar->piagam) }}">
                            Lihat Dokumen
                        </button>
                    @else
                        <span class="badge bg-secondary mt-2">Tidak Ada</span>
                    @endif
                </li>

                <li class="list-group-item px-0">
                    <strong>FC Kartu Sosial (KKS/PKH):</strong><br>
                    @if($pendaftar->kartu_sosial)
                        <!-- <a href="{{ asset('storage/'.$pendaftar->kartu_sosial) }}"
                           target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3">
                            Lihat Dokumen
                        </a> -->
                        <button 
                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#dokumenModal"
                            data-title="Kartu Sosial"
                            data-file="{{ asset('storage/'.$pendaftar->kartu_sosial) }}">
                            Lihat Dokumen
                        </button>
                    @else
                        <span class="badge bg-secondary mt-2">Tidak Ada</span>
                    @endif
                </li>

            </ul>
        </div>
    </div>

    {{--   CARD: STATUS BERKAS   --}}
    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 pb-2 border-bottom">Status Kelengkapan Berkas</h5>

            @if(
                $pendaftar->akta_kelahiran &&
                $pendaftar->kartu_keluarga &&
                $pendaftar->foto_siswa &&
                (
                    $pendaftar->status_siswa === 'baru' ||
                    (
                        $pendaftar->status_siswa === 'pindahan' &&
                        $pendaftar->surat_pindahan
                    )
                )
            )
                <span class="badge bg-success px-3 py-2 rounded-pill">
                    Berkas Lengkap (Siswa {{ ucfirst($pendaftar->status_siswa) }})
                </span>
            @else
                <span class="badge bg-danger px-3 py-2 rounded-pill">
                    Berkas Belum Lengkap
                </span>
            @endif

            <p class="text-muted mt-2">
                Usia minimal 6 tahun per 1 Juli 2025.  
                Jika kurang → wajib upload rekomendasi psikolog.
            </p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 pb-2 border-bottom">
                Pesan untuk Pendaftar
            </h5>

            <form method="POST" action="{{ route('admin.ppdb.pesan', $pendaftar->id) }}">
                @csrf

                <textarea name="pesan" rows="4"
                    class="form-control mb-3"
                    placeholder="Contoh: Akta kelahiran buram, mohon upload ulang dengan foto yang lebih jelas."
                    required></textarea>

                <button class="btn btn-primary">
                    <i class="bi bi-send"></i> Kirim Pesan
                </button>
            </form>
        </div>
    </div>
    <!-- MODAL PREVIEW DOKUMEN -->
<div class="modal fade" id="dokumenModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="modal-header border-0">
                <h6 class="modal-title fw-semibold" id="dokumenTitle"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-0 bg-dark">
                <iframe id="dokumenFrame"
                        src=""
                        style="width:100%; height:80vh; border:none; background:#fff;">
                </iframe>
            </div>

        </div>
    </div>
</div>


</div>
<style>
    .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 14px;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 999px;
    border: 1px solid transparent;
}

.status-badge.pindahan {
    background-color: #fff7e6;
    color: #b4690e;
    border-color: #ffe0b2;
}

.status-badge.baru {
    background-color: #ecfdf3;
    color: #0f5132;
    border-color: #c7f0da;
}

</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('dokumenModal');
    const modal = new bootstrap.Modal(modalEl);

    // Tombol klik dokumen
    modalEl.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const title = button.getAttribute('data-title');
        const file = button.getAttribute('data-file');

        document.getElementById('dokumenTitle').textContent = title;
        document.getElementById('dokumenFrame').src = file;

        // Tambahkan state ke history
        history.pushState({ modalOpen: true }, '', '#preview');
    });

    // Modal close
    modalEl.addEventListener('hidden.bs.modal', function () {
        document.getElementById('dokumenFrame').src = '';

        // Hapus hash agar back browser normal
        if (location.hash === '#preview') {
            history.back();
        }
    });

    // Tangkap back button
    window.addEventListener('popstate', function (event) {
        if (event.state && event.state.modalOpen) {
            modal.hide();
        }
    });
});
</script>

@endsection
