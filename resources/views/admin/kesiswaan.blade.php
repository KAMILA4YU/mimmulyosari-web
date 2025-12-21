@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">

    {{-- ========== JUDUL HALAMAN ========== --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0">
            Manajemen Kesiswaan
        </h4>
    </div>

    {{-- ========== ALERT SUCCESS ========== --}}
    @if(session('success'))
        <div id="alertSuccess" class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
            <strong><i class="bi bi-check-circle-fill me-1"></i> Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <script>
            setTimeout(() => {
                const alertEl = document.getElementById('alertSuccess');
                if (alertEl) {
                    alertEl.style.opacity = 0;
                    setTimeout(() => alertEl.remove(), 500);
                }
            }, 2500);
        </script>
    @endif

@php
    $activeTab = session('active_tab') ?: 'ekskul';
@endphp

    {{-- ==================== TAB NAVIGASI ==================== --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <ul class="nav nav-tabs px-3 pt-3" id="kesiswaanTabs" role="tablist">
                @foreach ([
                    'ekskul' => 'Ekstrakurikuler',
                    'organisasi' => 'Organisasi Siswa',
                    'keagamaan' => 'Kegiatan Keagamaan',
                    'prestasi' => 'Prestasi Sekolah',
                    'pembinaan' => 'Program Pembinaan',
                    'pengaturan' => 'Pengaturan Halaman'
                ] as $id => $label)
                <li class="nav-item">
                    <button class="nav-link {{ $activeTab === $id ? 'active' : '' }} fw-semibold"
                            data-bs-toggle="tab"
                            data-bs-target="#{{ $id }}">
                        {{ $label }}
                    </button>
                </li>
                @endforeach
            </ul>

            <div class="tab-content p-4">

                 
                {{-- ======================= TAB EKSKUL ====== --}}
                 
                <div class="tab-pane fade {{ $activeTab === 'ekskul' ? 'show active' : '' }}" id="ekskul">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-secondary">Daftar Ekstrakurikuler</h5>
                        <button class="btn btn-primary btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#addEkskul">
                            <i class="bi bi-plus-circle me-1"></i> Tambah
                        </button>
                    </div>

                    <div class="card shadow-sm border-0 rounded-4 p-3">
                        <div class="table-responsive">
                        @include('admin.partials.table', ['items' => $ekskul, 'kategori' => 'ekskul'])
                        </div>
                    </div>
                </div>

                <!-- MODAL TAMBAH EKSKUL -->
                    <div class="modal fade" id="addEkskul" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4 shadow">

                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">
                                        <i class="bi bi-plus-circle me-1"></i> Tambah Ekstrakurikuler
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <form action="{{ route('admin.kesiswaan.ekskul.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="active_tab" value="ekskul">

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="fw-semibold">Nama Ekstrakurikuler</label>
                                            <input type="text" name="nama" class="form-control rounded-3" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-semibold">Pembimbing</label>
                                            <input type="text" name="pembimbing" class="form-control rounded-3">
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-semibold">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control rounded-3" rows="3" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-semibold">Foto</label>
                                            <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-success rounded-3">
                                            <i class="bi bi-save me-1"></i> Simpan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                 
                {{--  TAB ORGANISASI  --}}
                
                <div class="tab-pane fade {{ $activeTab === 'organisasi' ? 'show active' : '' }}" id="organisasi">
                    
                    <h5 class="fw-bold text-secondary mb-3">Tambah Organisasi Siswa</h5>

                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                        <form method="POST" action="{{ route('admin.kesiswaan.organisasi.store') }}">
                            @csrf
                            <input type="hidden" name="active_tab" value="organisasi">

                            <div class="mb-3">
                                <label class="fw-semibold">Nama Organisasi</label>
                                <input type="text" name="nama" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control rounded-3" required></textarea>
                            </div>

                            <button class="btn btn-success rounded-3">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </form>
                    </div>

                    <h5 class="fw-bold text-secondary mb-3">Daftar Organisasi Siswa</h5>

                    <div class="card shadow-sm border-0 rounded-4 p-3">
                        <div class="table-responsive">
                        @include('admin.partials.table_noPembimbing', ['items' => $organisasi, 'kategori' => 'organisasi'])
                        </div>
                    </div>
                </div>

                 
                {{--  TAB KEAGAMAAN  --}}
                 
                
                <div class="tab-pane fade {{ $activeTab === 'keagamaan' ? 'show active' : '' }}" id="keagamaan">

                    <h5 class="fw-bold text-secondary mb-3">Tambah Kegiatan Keagamaan</h5>

                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                        <form method="POST" action="{{ route('admin.kesiswaan.keagamaan.store') }}">
                            @csrf
                            <input type="hidden" name="active_tab" value="keagamaan">

                            <div class="mb-3">
                                <label class="fw-semibold">Nama Kegiatan</label>
                                <input type="text" name="nama" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control rounded-3" required></textarea>
                            </div>

                            <button class="btn btn-success rounded-3">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </form>
                    </div>

                    <h5 class="fw-bold text-secondary mb-3">Daftar Kegiatan Keagamaan</h5>
                    <div class="card shadow-sm border-0 rounded-4 p-3">
                        <div class="table-responsive">
                        @include('admin.partials.table_noPembimbing', ['items' => $keagamaan, 'kategori' => 'keagamaan'])
                        </div>
                    </div>
                </div>

                 
                {{--  TAB PRESTASI  --}}
                 
                <div class="tab-pane fade {{ $activeTab === 'prestasi' ? 'show active' : '' }}" id="prestasi">

                    <h5 class="fw-bold text-secondary mb-3">Tambah Prestasi Sekolah</h5>

                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                        <form method="POST" action="{{ route('admin.kesiswaan.prestasi.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="prestasi">

                            <div class="mb-3">
                                <label class="fw-semibold">Judul Prestasi</label>
                                <input type="text" name="judul" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Foto Prestasi</label>
                                <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control rounded-3"></textarea>
                            </div>

                            <button class="btn btn-success rounded-3">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </form>
                    </div>

                    <h5 class="fw-bold text-secondary mb-3">Daftar Prestasi</h5>
                    <div class="card shadow-sm border-0 rounded-4 p-3">
                        <div class="table-responsive">
                        @include('admin.partials.table_prestasi', ['items' => $prestasi])
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $prestasi->appends(['tab' => 'prestasi'])->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

                 
                {{--  TAB PEMBINAAN  --}}
                 
                <div class="tab-pane fade {{ $activeTab === 'pembinaan' ? 'show active' : '' }}" id="pembinaan">

                    <h5 class="fw-bold text-secondary mb-3">Tambah Program Pembinaan</h5>

                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                        <form method="POST" action="{{ route('admin.kesiswaan.pembinaan.store') }}">
                            @csrf
                            <input type="hidden" name="active_tab" value="pembinaan">

                            <div class="mb-3">
                                <label class="fw-semibold">Nama Program</label>
                                <input type="text" name="nama" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control rounded-3" required></textarea>
                            </div>

                            <button class="btn btn-success rounded-3">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </form>
                    </div>

                    <h5 class="fw-bold text-secondary mb-3">Program Pembinaan</h5>

                    <div class="card shadow-sm border-0 rounded-4 p-3">
                        <div class="table-responsive">
                        @include('admin.partials.table_noPembimbing', ['items' => $pembinaan, 'kategori' => 'pembinaan'])
                        </div>
                    </div>
                </div>

                 
                {{--  TAB PENGATURAN  --}}
                 
                <div class="tab-pane fade {{ $activeTab === 'pengaturan' ? 'show active' : '' }}" id="pengaturan">

                    <h5 class="fw-bold text-secondary mb-3">Pengaturan Halaman</h5>

                    <div class="card shadow-sm border-0 rounded-4 p-4">

                        <form method="POST" action="{{ route('admin.kesiswaan.pengaturan.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="pengaturan">

                            <label class="fw-semibold">Foto Header / Kegiatan</label>
                            <input type="file" name="foto_header" class="form-control rounded-3" accept="image/*">

                            <div>
                            @if($pengaturan?->foto_header)
                                <img src="{{ asset('storage/' . $pengaturan->foto_header) }}"
                                    class="img-fluid rounded mt-3 shadow-sm"
                                    width="300">
                            @endif

                            </div>

                            <label class="fw-semibold mt-3">Deskripsi Halaman</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="4" required>{{ $pengaturan?->deskripsi }}</textarea>

                            <button class="btn btn-primary mt-3 rounded-3">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let activeTab = "{{ session('active_tab') ?: 'ekskul' }}";
    let triggerEl = document.querySelector(
        'button[data-bs-target="#' + activeTab + '"]'
    );

    if (triggerEl) {
        let tab = new bootstrap.Tab(triggerEl);
        tab.show();
    }
});
</script>

@endsection
