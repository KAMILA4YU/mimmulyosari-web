<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Judul Prestasi</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->judul ?? '-' }}</td>
            <td>{{ $item->deskripsi }}</td>

            <td>
                @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                        alt="Foto Prestasi" 
                        width="100">
                @else
                    Tidak ada
                @endif
            </td>

            <td class="text-center">
                <x-action-buttons>

                    <!-- EDIT -->
                    <button class="btn btn-outline-warning btn-sm btn-action"
                            data-bs-toggle="modal"
                            data-bs-target="#editPrestasi{{ $item->id }}"
                            title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- HAPUS -->
                    <form action="{{ route('admin.kesiswaan.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin hapus prestasi ini?')">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="active_tab" value="prestasi">

                        <button type="submit"
                                class="btn btn-outline-danger btn-sm btn-action"
                                title="Hapus">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>

                </x-action-buttons>
            </td>

        </tr>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="editPrestasi{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('admin.kesiswaan.update', $item->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="kategori" value="prestasi">
                    <input type="hidden" name="active_tab" value="prestasi">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Prestasi</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <label>Judul Prestasi</label>
                            <input type="text" class="form-control" name="judul"
                                   value="{{ $item->judul }}" required>

                            <label class="mt-2">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required>{{ $item->deskripsi }}</textarea>

                            <label class="mt-2">Foto</label>
                            <input type="file" class="form-control" name="gambar">

                            @if($item->foto)
                                <p class="mt-2">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $item->foto) }}" width="120" class="rounded">
                            @endif

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">Belum ada prestasi.</td>
        </tr>
        @endforelse
    </tbody>
</table>
