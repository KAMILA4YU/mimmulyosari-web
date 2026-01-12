<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Pembimbing</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->pembimbing ?? '-' }}</td>
            <td>{{ $item->deskripsi }}</td>

            <td class="text-center">
                <x-action-buttons>

                    <!-- EDIT -->
                    <button class="btn btn-outline-warning btn-sm btn-action"
                            data-bs-toggle="modal"
                            data-bs-target="#edit{{ $item->id }}"
                            title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- HAPUS -->
                    <form action="{{ route('admin.kesiswaan.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="active_tab" value="{{ $kategori }}">

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
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
               <form action="{{ route('admin.kesiswaan.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="kategori" value="{{ $item->kategori }}">
                    <input type="hidden" name="active_tab" value="{{ $kategori }}">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit {{ ucfirst($item->kategori) }}</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" required>

                            <label class="mt-2">Pembimbing (opsional)</label>
                            <input type="text" class="form-control" name="pembimbing"
                                   value="{{ $item->pembimbing }}">

                            <label class="mt-2">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required>{{ $item->deskripsi }}</textarea>

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
            <td colspan="5" class="text-center text-muted">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>
