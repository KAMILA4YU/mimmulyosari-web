@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4 fw-bold text-primary">
        Data Guru & Siswa
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- TAB NAV -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="{{ route('admin.siswa.index', ['tab' => 'guru']) }}"
            class="nav-link {{ request('tab','guru') == 'guru' ? 'active' : '' }}">
                Guru
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.siswa.index', ['tab' => 'siswa']) }}"
            class="nav-link {{ request('tab') == 'siswa' ? 'active' : '' }}">
                Siswa
            </a>
        </li>
    </ul>

    <!-- TAB CONTENT -->
    <div class="tab-content p-4 bg-white border border-top-0 rounded-bottom shadow-sm">

        <!--   TAB GURU   -->
        <div class="tab-pane fade {{ session('active_tab', 'guru') == 'guru' ? 'show active' : '' }}" id="guru">
            <div class="row">
                @forelse ($gurus as $guru)
                    <div class="col-6 col-md-3 col-xl-2 mb-3 guru-col">
                        <div class="card shadow-sm h-100">

                            <img src="{{ $guru->foto_url }}" class="card-img-top guru-img">

                            <div class="card-body text-center">
                                <h6 class="fw-bold mb-1">{{ $guru->nama }}</h6>
                                <p class="text-muted mb-2">{{ $guru->jabatan }}</p>
                            </div>

                        </div>
                    </div>
                @empty
                <div class="text-center text-muted">Belum ada data guru.</div>
                @endforelse
            </div>
        </div>

        <!--   TAB SISWA   -->
        <div class="tab-pane fade {{ session('active_tab') == 'siswa' ? 'show active' : '' }}" id="siswa">

        <div class="row">

    <!-- IMPORT SISWA -->
    <div class="col-12 col-lg-5 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-success text-white fw-bold">
                Import Data Siswa (Excel)
            </div>
            <div class="card-body">

                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <input type="file" name="file" class="form-control" required>
                        <small class="text-muted">
                            Format: .xlsx | Kolom: nama_lengkap, nisn, kelas, nama_ortu, no_hp
                        </small>
                    </div>

                    <button class="btn btn-success w-100">
                        <i class="bi bi-upload"></i> Import Excel
                    </button>

                </form>

            </div>
        </div>
    </div>

    <!-- TAMBAH SISWA -->
    <div class="col-12 col-lg-7 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white fw-bold">
                Tambah Siswa
            </div>
            <div class="card-body">

                <form action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf

                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">NISN</label>
                            <input type="text" name="nisn" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kelas</label>
                            <input type="text" name="kelas" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nama Orang Tua</label>
                            <input type="text" name="nama_ortu" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control">
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 mt-3">
                        + Tambah Siswa
                    </button>

                </form>

            </div>
        </div>
    </div>

</div>


            <!-- SEARCH BAR -->
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.siswa.index') }}">
                        <input type="hidden" name="tab" value="siswa">

                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control" placeholder="Cari nama / NISN siswa...">
                            <button class="btn btn-secondary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- LIST SISWA -->
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white fw-bold">
                    Daftar Siswa
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <div class="alert alert-info fw-bold">
                            Total Siswa: {{ $totalSiswa }}
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Siswa</th>
                                    <th>NISN</th>
                                    <th>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-dark fw-bold text-decoration-none"
                                            href="#"
                                            role="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                                Kelas {{ request('kelas') ? request('kelas') : '' }}
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                    href="{{ route('admin.siswa.index', ['tab'=>'siswa']) }}">
                                                        Semua Kelas
                                                    </a>
                                                </li>
                                                @for ($i = 1; $i <= 6; $i++)
                                                    <li>
                                                        <a class="dropdown-item"
                                                        href="{{ route('admin.siswa.index', [
                                                            'tab' => 'siswa',
                                                            'kelas' => $i,
                                                            'search' => request('search')
                                                        ]) }}">
                                                            Kelas {{ $i }}
                                                        </a>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </th>
                                    <th>Nama Orang Tua</th>
                                    <th>No HP</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($siswas as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->nama_lengkap }}</td>
                                        <td>{{ $s->nisn }}</td>
                                        <td>{{ $s->kelas ?? '-' }}</td>
                                        <td>{{ $s->nama_ortu }}</td>
                                        <td>{{ $s->no_hp }}</td>
                                        <td class="text-center">
                                            <x-action-buttons>

                                                <!-- EDIT -->
                                                <button class="btn btn-sm btn-outline-warning btn-action"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editSiswa{{ $s->id }}"
                                                        title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- HAPUS -->
                                                <form action="{{ route('admin.siswa.destroy', $s->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin hapus siswa ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="tab" value="siswa">

                                                    <button class="btn btn-sm btn-outline-danger btn-action"
                                                            title="Hapus">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>

                                            </x-action-buttons>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada siswa.</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                        <div class="mt-3">
                            {{ $siswas->links('pagination::bootstrap-5') }}
                        </div>

                        @foreach ($siswas as $s)
                        <div class="modal fade" id="editSiswa{{ $s->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('admin.siswa.update', $s->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tab" value="siswa">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Siswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label">Nama Siswa</label>
                                                    <input type="text" name="nama_lengkap" class="form-control"
                                                        value="{{ $s->nama_lengkap }}" required>
                                                </div>

                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label">NISN</label>
                                                    <input type="text" name="nisn" class="form-control"
                                                        value="{{ $s->nisn }}" required>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Kelas</label>
                                                    <input type="text" name="kelas" class="form-control"
                                                        value="{{ $s->kelas }}">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Nama Orang Tua</label>
                                                    <input type="text" name="nama_ortu" class="form-control"
                                                        value="{{ $s->nama_ortu }}">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">No HP</label>
                                                    <input type="text" name="no_hp" class="form-control"
                                                        value="{{ $s->no_hp }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>

        </div> <!-- END TAB SISWA -->

    </div> <!-- END TAB CONTENT -->

</div>
<style>
    /* === GRID GURU === */
.guru-col .card {
    font-size: 0.85rem;
}

.guru-col .card-body {
    padding: 0.6rem;
}

.guru-col h6 {
    font-size: 0.85rem;
    margin-bottom: 2px;
}

.guru-col p {
    font-size: 0.75rem;
    margin-bottom: 0;
}

/* === FOTO GURU RESPONSIVE === */
.guru-img {
    width: 100%;
    aspect-ratio: 3 / 4;   /* konsisten */
    object-fit: cover;
    object-position: top;
}

/* Desktop: foto lebih ramping */
@media (min-width: 1200px) {
    .guru-img {
        aspect-ratio: 2 / 3;
    }
}

</style>
@endsection
