@extends('layouts.user')

@section('title', 'Hasil PPDB')

@section('content')
<div class="container mt-4">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">

            <h2 class="fw-bold mb-3 text-primary">
                <i class="bi bi-clipboard-check"></i> Status Pendaftaran PPDB
            </h2>

            {{-- Jika sudah daftar --}}
            @if($ppdb)

                {{-- STATUS --}}
                <div class="
                    alert 
                    @if($ppdb->status == 'pending') alert-warning
                    @elseif($ppdb->status == 'diterima') alert-success
                    @else alert-danger
                    @endif
                    rounded-3
                ">
                    <strong>Status:</strong> 
                    <span class="text-uppercase fw-bold">{{ $ppdb->status }}</span>
                    <br>

                    @if($ppdb->status == 'pending')
                        <small>Menunggu verifikasi dari admin.</small>
                    @elseif($ppdb->status == 'diterima')
                        <small>Selamat! Kamu telah diterima di MI Muhammadiyah Mulyosari</small>
                    @else
                        <small>Mohon maaf, pendaftaran kamu belum diterima.</small>
                    @endif
                </div>

                {{-- CARD DATA DETAIL --}}
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-bold">
                        Data Diri Calon Siswa
                    </div>
                    <div class="card-body">
                        <p><strong>Nama:</strong> {{ $ppdb->nama_lengkap }}</p>
                        <p><strong>NIK:</strong> {{ $ppdb->nik }}</p>
                        <p><strong>Jenis Kelamin:</strong> 
                            {{ $ppdb->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                        <p><strong>Tanggal Lahir:</strong> {{ $ppdb->tanggal_lahir }}</p>
                        <p><strong>Alamat:</strong> {{ $ppdb->alamat }}</p>
                    </div>
                </div>

                {{-- BERKAS --}}
                <h4 class="fw-bold mt-4">Berkas yang Diupload</h4>

                @if($ppdb->status_siswa === 'pindahan')
                <div class="alert alert-warning rounded-3 mt-3">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    <strong>Catatan:</strong> Surat pindahan wajib diunggah untuk siswa pindahan.
                </div>
                @endif

                <div class="table-responsive">
                    @if($ppdb->pesan->where('is_read', false)->count())
                        <div class="alert alert-warning rounded-3 mt-3">
                            <h5 class="fw-bold mb-2">
                                <i class="bi bi-chat-left-text-fill"></i>
                                Pesan dari Admin
                            </h5>

                            <ul class="mb-0 ps-0">
                                @foreach($ppdb->pesan->where('is_read', false) as $pesan)
                                    <li class="mb-3 list-unstyled position-relative">

                                        <div class="d-flex flex-column flex-md-row align-items-start">

                                            {{-- TEKS PESAN --}}
                                            <div class="flex-grow-1 pe-md-3">
                                                {{ $pesan->pesan }}
                                                <br>
                                                <small class="text-muted">
                                                    {{ $pesan->created_at->format('d M Y H:i') }}
                                                </small>
                                            </div>

                                            {{-- TOMBOL --}}
                                            <form action="{{ route('user.ppdb.pesan.read', $pesan->id) }}"
                                                method="POST"
                                                class="ms-md-2
                                                        position-absolute position-md-static
                                                        bottom-0 end-0
                                                        mb-0 me-1
                                                        mt-md-0">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-sm btn-outline-success px-2 py-1">
                                                    <i class="bi bi-check-circle"></i>
                                                    <span class="d-none d-md-inline">Sudah diperbarui</span>
                                                </button>
                                            </form>

                                        </div>

                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    @endif
                </div>


                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="">Dokumen</th>
                            <th class="">Status</th>
                            <th class="">Syarat</th>
                            <th class="d-md-table-cell text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- AKTA KELAHIRAN --}}
                        <tr>
                            <td>
                                FC Akta Kelahiran
                                <!-- <a href="{{ asset('storage/'.$ppdb->akta_kelahiran) }}" target="_blank" class="ms-2">
                                    <i class="bi bi-eye"></i>
                                </a> -->
                                <a href="#"
                                    class="ms-2 preview-btn"
                                    data-file="{{ asset('storage/'.$ppdb->akta_kelahiran) }}"
                                    data-title="FC Akta Kelahiran">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td><span class="badge bg-success">lengkap</span></td>
                            <td><span class="badge bg-danger">wajib</span></td>
                            <td class="d-md-table-cell text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    onclick="setField('akta_kelahiran')">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- KARTU KELUARGA --}}
                        <tr>
                            <td>
                                FC Kartu Keluarga
                                <!-- <a href="{{ asset('storage/'.$ppdb->kartu_keluarga) }}" target="_blank" class="ms-2">
                                    <i class="bi bi-eye"></i>
                                </a> -->
                                <a href="#"
                                    class="ms-2 preview-btn"
                                    data-file="{{ asset('storage/'.$ppdb->kartu_keluarga) }}"
                                    data-title="FC Kartu Keluarga">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td><span class="badge bg-success">lengkap</span></td>
                            <td><span class="badge bg-danger">wajib</span></td>
                            <td class="d-md-table-cell text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    onclick="setField('kartu_keluarga')">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- FOTO SISWA --}}
                        <tr>
                            <td>
                                Pas Foto Siswa 3&times;4
                                <!-- <a href="{{ asset('storage/'.$ppdb->foto_siswa) }}" target="_blank" class="ms-2">
                                    <i class="bi bi-eye"></i>
                                </a> -->
                                <a href="#"
                                    class="ms-2 preview-btn"
                                    data-file="{{ asset('storage/'.$ppdb->foto_siswa) }}"
                                    data-title="Pas Foto Siswa">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td><span class="badge bg-success">lengkap</span></td>
                            <td><span class="badge bg-danger">wajib</span></td>
                            <td class="d-md-table-cell text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    onclick="setField('foto_siswa')">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- IJAZAH TK --}}
                        <tr>
                            <td>
                                FC Ijazah TK
                                @if($ppdb->ijazah_tk)
                                    <!-- <a href="{{ asset('storage/'.$ppdb->ijazah_tk) }}" target="_blank" class="ms-2">
                                        <i class="bi bi-eye"></i>
                                    </a> -->
                                    <a href="#"
                                    class="ms-2 preview-btn"
                                    data-file="{{ asset('storage/'.$ppdb->ijazah_tk) }}"
                                    data-title="FC Ijazah TK">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($ppdb->ijazah_tk)
                                    <span class="badge bg-success">lengkap</span>
                                @else
                                    <span class="badge bg-secondary">belum</span>
                                @endif
                            </td>
                            <td><span class="badge bg-danger">wajib</span></td>
                            <td class="d-md-table-cell text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    onclick="setField('ijazah_tk')">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- SURAT PINDAHAN (KHUSUS SISWA PINDAHAN) --}}
                        @if($ppdb->status_siswa === 'pindahan')
                        <tr>
                            <td>
                                Surat Pindahan
                                @if($ppdb->surat_pindahan)
                                    <!-- <a href="{{ asset('storage/'.$ppdb->surat_pindahan) }}" target="_blank" class="ms-2">
                                        <i class="bi bi-eye"></i>
                                    </a> -->
                                    <a href="#"
                                    class="ms-2 preview-btn"
                                    data-file="{{ asset('storage/'.$ppdb->surat_pindahan) }}"
                                    data-title="Surat Pindahan">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @endif
                            </td>

                            <td>
                                @if($ppdb->surat_pindahan)
                                    <span class="badge bg-success">lengkap</span>
                                @else
                                    <span class="badge bg-secondary">belum</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge bg-danger">wajib</span>
                            </td>

                            <td class="d-md-table-cell text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    onclick="setField('surat_pindahan')">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>
                        @endif

                        {{-- PIAGAM --}}
                        <tr>
                            <td>
                                Piagam
                                @if($ppdb->piagam)
                                    <!-- <a href="{{ asset('storage/'.$ppdb->piagam) }}" target="_blank" class="ms-2">
                                        <i class="bi bi-eye"></i>
                                    </a> -->
                                    <a href="#"
                                    class="ms-2 preview-btn"
                                    data-file="{{ asset('storage/'.$ppdb->piagam) }}"
                                    data-title="Piagam">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($ppdb->piagam)
                                    <span class="badge bg-success">lengkap</span>
                                @else
                                    <span class="badge bg-secondary">belum</span>
                                @endif
                            </td>
                            <td><span class="badge bg-primary">opsional</span></td>
                            <td class="d-md-table-cell text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    onclick="setField('piagam')">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- KARTU SOSIAL --}}
                        <tr>
                            <td>
                                FC Kartu Sosial (KIS / PKH / KKS)
                                @if($ppdb->kartu_sosial)
                                    <!-- <a href="{{ asset('storage/'.$ppdb->kartu_sosial) }}" target="_blank" class="ms-2">
                                        <i class="bi bi-eye"></i>
                                    </a> -->
                                    <a href="#"
                                    class="ms-2 preview-btn"
                                    data-file="{{ asset('storage/'.$ppdb->kartu_sosial) }}"
                                    data-title="FC Kartu Sosial">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($ppdb->kartu_sosial)
                                    <span class="badge bg-success">lengkap</span>
                                @else
                                    <span class="badge bg-secondary">belum</span>
                                @endif
                            </td>
                            <td><span class="badge bg-primary">opsional</span></td>
                            <td class="d-md-table-cell text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    onclick="setField('kartu_sosial')">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
                </div>

                <div class="modal fade" id="uploadModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm modal-md">
                        <form method="POST"
                            action="{{ route('user.ppdb.uploadUlang') }}"
                            enctype="multipart/form-data"
                            class="modal-content">
                        @csrf

                        <input type="hidden" name="field" id="field">

                        <div class="modal-header">
                            <h5 class="modal-title">Upload Ulang Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-label fw-semibold">Pilih Berkas</label>
                            <input type="file" name="file" class="form-control" required>

                            <div class="form-text">
                                File lama akan diganti setelah di-upload.
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-primary">
                                Upload
                            </button>
                        </div>

                        </form>
                    </div>
                    </div>

                    <!-- MODAL PREVIEW BERKAS -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="modal-header border-0">
                <h6 class="modal-title fw-semibold" id="previewTitle"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-0 bg-dark">
                <iframe id="previewFrame"
                        src=""
                        style="width:100%; height:80vh; border:none; background:#fff;">
                </iframe>
            </div>

        </div>
    </div>
</div>

                    <script>
                    function setField(field) {
                        document.getElementById('field').value = field;
                    }
                    </script>
                    <style>
                    @media (max-width: 375px) {
                        #uploadModal .modal-dialog {
                            max-width: 95%;
                            margin: 0.75rem auto;
                        }

                        #uploadModal .modal-content {
                            max-height: 90vh;
                            overflow-y: auto;
                        }
                    }
                    </style>

                <!-- Info Cetak -->
                @if($ppdb->status != 'diterima')
                    <div class="px-3">
                        <div class="alert alert-info rounded-3 mt-4 mb-4">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-info-circle-fill fs-5 mt-1"></i>

                                <div>
                                    <strong>Info:</strong>
                                        Bukti pendaftaran <b>hanya dapat dicetak</b> setelah
                                        status pendaftaran calon peserta didik dinyatakan
                                        <span class="fw-bold">DITERIMA</span>.
                                        <br>
                                        Mohon memantau status pendaftaran secara berkala melalui portal PPDB online.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- Cetak PDF -->
                @if($ppdb->status == 'diterima')
                    <div class="px-3 mt-4">
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-6 col-lg-5">

                                <div class="alert alert-primary rounded-3
                                            mb-3 mb-md-4 mb-lg-5
                                            d-flex flex-column flex-sm-row
                                            justify-content-between align-items-start align-items-sm-center
                                            gap-3">

                                    {{-- KIRI: ICON + TEKS --}}
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-file-earmark-pdf-fill fs-5 mt-1"></i>
                                        <div>
                                            <strong>Bukti Pendaftaran</strong><br>
                                            <small>Silakan cetak bukti pendaftaran PPDB.</small>
                                        </div>
                                    </div>

                                    {{-- KANAN: TOMBOL --}}
                                    <a href="{{ route('user.ppdb.cetak') }}"
                                    target="_blank"
                                    class="btn btn-primary btn-sm flex-shrink-0">
                                        <i class="bi bi-printer"></i>
                                        Cetak
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                @endif


            @else
                {{-- Belum daftar --}}
                <div class="alert alert-warning rounded-3">
                    <h5 class="fw-bold mb-1">Belum Ada Pendaftaran</h5>
                    Kamu belum mengisi formulir PPDB.
                </div>

                <a href="{{ route('user.ppdb.form') }}" class="btn btn-primary">
                    Isi Formulir PPDB Sekarang
                </a>
            @endif

        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('previewModal');
    const modal = new bootstrap.Modal(modalEl);

    // Klik tombol preview
    document.querySelectorAll('.preview-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const file = this.dataset.file;
            const title = this.dataset.title;

            document.getElementById('previewTitle').textContent = title;
            document.getElementById('previewFrame').src = file;

            modal.show();

            // Tambahkan state ke history
            history.pushState({ modalOpen: true }, '', '#preview');
        });
    });

    // Close modal
    modalEl.addEventListener('hidden.bs.modal', function () {
        document.getElementById('previewFrame').src = '';

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
