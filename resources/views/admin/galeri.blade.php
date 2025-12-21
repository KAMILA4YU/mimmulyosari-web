@extends('layouts.admin')

@section('content')

<div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-3 mb-md-0">
            Manajemen Galeri Sekolah
        </h4>
</div>

    @if(session('success'))
        <div id="alertSuccess"
            class="alert alert-success alert-dismissible fade show mb-3"
            role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <script>
            setTimeout(() => {
                const el = document.getElementById('alertSuccess');
                if (el) {
                    el.classList.remove('show');
                    setTimeout(() => el.remove(), 300);
                }
            }, 2500);
        </script>
    @endif

    <div class="card">
        <div class="card-body">

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-circle"></i> Tambah Foto
            </button>

            {{-- Grid Galeri --}}
            <div class="row g-4">
                @forelse ($galeris as $item)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card shadow-sm galeri-card h-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             class="card-img-top" style="height:180px;object-fit:cover;">

                        <div class="card-body text-center">
                            <h6 class="fw-semibold small mb-1">{{ $item->judul }}</h6>

                            @if ($item->keterangan)
                                <p class="text-muted small mb-2">{{ $item->keterangan }}</p>
                            @endif

                            <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEdit{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>

                            <form action="{{ route('admin.galeri.destroy', $item->id) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

                {{-- Modal Edit --}}
                <div class="modal fade" id="modalEdit{{ $item->id }}">
                  <div class="modal-dialog">
                    <form action="{{ route('admin.galeri.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control mb-2" value="{{ $item->judul }}" required>

                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control mb-2">{{ $item->keterangan }}</textarea>

                            <label>Ganti Gambar (opsional)</label>
                            <input type="file" name="gambar" class="form-control mb-2">
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                  </div>
                </div>

                @empty
                <p class="text-center">Belum ada foto.</p>
                @endforelse
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $galeris->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf

        <div class="modal-header">
            <h5 class="modal-title">Tambah Foto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control mb-2" required>

            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control mb-2"></textarea>

            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control mb-2" required>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary">Simpan</button>
        </div>

    </form>
  </div>
</div>
<style>
.galeri-card img {
    transition: transform .3s ease;
}
.galeri-card:hover img {
    transform: scale(1.05);
}
</style>
@endsection
