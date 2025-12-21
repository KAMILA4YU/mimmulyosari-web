<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold">{{ $title }}</h5>
    <button class="btn btn-primary btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#modalInformasi"
            onclick="createInformasi('{{ $kategori }}')">
        + Tambah {{ ucfirst($kategori) }}
    </button>
</div>

<div class="card shadow-sm border-0" data-kategori="{{ $kategori }}">
    <div class="card-body p-0">
        <table class="table mb-0 table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $info)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $info->judul }}</td>
                    <td>{{ $info->tanggal ? \Carbon\Carbon::parse($info->tanggal)->format('d M Y') : '-' }}</td>
                    <td class="text-center">
                        <div class="d-inline-flex gap-1">

                            {{-- EDIT --}}
                            <button class="btn btn-outline-warning btn-sm btn-action"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditInformasi"

                                data-id="{{ $info->id }}"
                                data-judul="{{ $info->judul }}"
                                data-tanggal="{{ $info->tanggal }}"
                                data-isi="{{ $info->isi }}"

                                onclick="openEditModal(this)"
                                title="Edit Informasi">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            {{-- HAPUS --}}
                            <form action="{{ route('admin.informasi.destroy', $info->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus informasi ini?')">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="active_tab" value="{{ $kategori }}">

                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm btn-action"
                                        title="Hapus Informasi">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
            {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}

        </table>
    </div>
</div>
