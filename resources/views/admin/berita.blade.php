@extends('layouts.admin')

@section('content')
<style>
    /*  STYLE MODERN AESTHETIC  */
    .table thead th {
        background: linear-gradient(135deg, #0d6efd, #3f8bff);
        color: #fff;
        font-weight: 600;
        letter-spacing: .3px;
        border: none;
    }
    .table tbody tr {
        transition: 0.2s ease;
    }
    .table tbody tr:hover {
        background: #f8f9fa;
    }
    .img-thumb {
        width: 80px;
        height: 55px;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }
    .btn-sm {
        padding: 6px 14px !important;
        font-size: 0.85rem !important;
        border-radius: 6px;
    }
    @media(max-width: 768px){
        .table-responsive {
            border-radius: 10px;
            overflow-x: auto;
        }
        .btn-sm {
            width: 100%;
            margin-bottom: 6px;
        }
        td:nth-child(3) img {
            width: 65px !important;
            height: 45px !important;
        }
    }
</style>

<div class="container mt-4">

    <h4 class="mb-3 fw-bold text-primary">
        Manajemen Berita Sekolah
    </h4>

    <!-- Alert sukses -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- Tombol tambah -->
    <button class="btn btn-primary mb-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahBeritaModal">
        <i class="bi bi-plus-circle"></i> Tambah Berita
    </button>

    <!-- Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 35%">Judul</th>
                            <th style="width: 15%">Tanggal</th>
                            <th style="width: 20%">Gambar</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($berita as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->judul }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border shadow-sm">
                                        {{ $item->tanggal ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/'.$item->gambar) }}" class="img-thumb">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <!-- Edit -->
                                        <button 
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $item->id }}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>

                                        <!-- Hapus -->
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" 
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning text-white">
                                            <h5 class="modal-title">Edit Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('admin.berita.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf @method('PUT')

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Judul</label>
                                                    <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Tanggal</label>
                                                    <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Isi</label>
                                                    <textarea name="isi" rows="5" class="form-control" required>{{ $item->isi }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Gambar</label><br>
                                                    @if($item->gambar)
                                                        <img src="{{ asset('storage/'.$item->gambar) }}" width="120" class="rounded mb-2 shadow-sm">
                                                    @endif
                                                    <input type="file" name="gambar" class="form-control">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada berita.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $berita->links('pagination::bootstrap-5') }}
    </div>

</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahBeritaModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Berita Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Isi</label>
                        <textarea name="isi" rows="5" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
