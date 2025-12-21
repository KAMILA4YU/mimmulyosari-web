@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-3 mb-md-0">
            Manajemen Artikel Sekolah
        </h4>
        <!-- <a href="#tambahArtikel" class="btn btn-success shadow-sm">Tambah Artikel Baru</a> -->
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Tambah Artikel --}}
    <div class="card mb-4 shadow-sm" id="tambahArtikel">
        <div class="card-header bg-primary text-white fw-semibold">Tambah Artikel Baru</div>
        <div class="card-body">
            <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="penulis" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Isi Artikel</label>
                        <textarea name="isi" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success mt-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Artikel --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white fw-semibold">Daftar Artikel</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 25%">Judul</th>
                        <th style="width: 15%">Penulis</th>
                        <th style="width: 15%">Tanggal</th>
                        <th style="width: 15%">Gambar</th>
                        <th style="width: 30%">Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach ($artikels as $artikel)
                            <tr>
                                <td title="{{ $artikel->judul }}">
                                    {{ Str::limit($artikel->judul, 40) }}
                                </td>
                                <td>{{ $artikel->penulis }}</td>
                                <td>{{ $artikel->tanggal }}</td>
                                <td>
                                    @if($artikel->gambar)
                                        <img src="{{ asset('storage/'.$artikel->gambar) }}" class="img-fluid rounded" style="max-width: 80px;">
                                    @endif
                                </td>
                                <td class="d-flex flex-column gap-2">

                                    {{-- TOGGLE UPDATE --}}
                                    <button class="btn btn-outline-warning btn-sm w-100 d-flex align-items-center justify-content-center gap-1 toggle-update-btn"
                                            type="button"
                                            data-target="#editArtikel{{ $artikel->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                        <span class="btn-text">Update</span>
                                    </button>

                                    {{-- FORM UPDATE --}}
                                    <div class="collapse" id="editArtikel{{ $artikel->id }}">
                                        <form action="{{ route('admin.artikel.update', $artikel->id) }}"
                                            method="POST"
                                            enctype="multipart/form-data"
                                            class="border rounded-3 p-2 bg-light">

                                            @csrf
                                            @method('PUT')

                                            <input type="text" name="judul" value="{{ $artikel->judul }}" class="form-control mb-1">
                                            <input type="text" name="penulis" value="{{ $artikel->penulis }}" class="form-control mb-1">
                                            <input type="date" name="tanggal" value="{{ $artikel->tanggal }}" class="form-control mb-1">
                                            <textarea name="isi" class="form-control mb-1" rows="2">{{ $artikel->isi }}</textarea>
                                            <input type="file" name="gambar" class="form-control mb-2">

                                            <button type="submit"
                                                    class="btn btn-warning btn-sm w-100 d-flex align-items-center justify-content-center gap-1">
                                                <i class="bi bi-save"></i>
                                                Simpan Update
                                            </button>
                                        </form>
                                    </div>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.artikel.destroy', $artikel->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin hapus artikel ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                title="Hapus Artikel">
                                            <i class="bi bi-trash3"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $artikels->links() }}
            </div>

        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.toggle-update-btn').forEach(button => {

        const target = document.querySelector(button.dataset.target);
        const text = button.querySelector('.btn-text');
        const icon = button.querySelector('i');

        const collapse = new bootstrap.Collapse(target, {
            toggle: false
        });

        button.addEventListener('click', function () {
            if (target.classList.contains('show')) {
                collapse.hide();
            } else {
                collapse.show();
            }
        });

        target.addEventListener('shown.bs.collapse', function () {
            text.textContent = 'Batal Update';
            button.classList.replace('btn-outline-warning', 'btn-outline-secondary');
            icon.className = 'bi bi-x-circle';
        });

        target.addEventListener('hidden.bs.collapse', function () {
            text.textContent = 'Update';
            button.classList.replace('btn-outline-secondary', 'btn-outline-warning');
            icon.className = 'bi bi-pencil-square';
        });

    });

});
</script>

@endsection
