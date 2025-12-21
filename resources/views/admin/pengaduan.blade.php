@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h4 class="fw-bold text-primary mb-4">
        Pengaduan User
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Daftar Pengaduan</h5>

                <form method="GET" class="d-flex gap-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>

                    <select name="bulan" class="form-select form-select-sm">
                        <option value="">Semua Bulan</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->locale('id')->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>

                    <select name="tahun" class="form-select form-select-sm">
                        <option value="">Semua Tahun</option>
                        @for($y = now()->year; $y >= now()->year - 5; $y--)
                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>

                    <button class="btn btn-sm btn-primary">Filter</button>

                    @if(request()->anyFilled(['status','bulan','tahun']))
                        <a href="{{ route('admin.pengaduan.index') }}"
                        class="btn btn-sm btn-secondary">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Subjek</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduans as $p)
                        <tr>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->subjek }}</td>
                            <td>
                                @if($p->status == 'Menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($p->status == 'Diproses')
                                    <span class="badge bg-info text-dark">Diproses</span>
                                @elseif($p->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-wrap justify-content-center gap-2">

                                    {{-- LIHAT --}}
                                    <a href="{{ route('admin.pengaduan.show', $p->id) }}"
                                    class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1"
                                    title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                        <span class="d-none d-md-inline">Lihat</span>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.pengaduan.destroy', $p->id) }}"
                                        method="POST"
                                        class="mb-0"
                                        onsubmit="return confirm('Yakin mau dihapus?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1"
                                                title="Hapus Pengaduan">
                                            <i class="bi bi-trash3"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <strong>Belum ada pengaduan</strong>
                                    @if(request()->anyFilled(['status','bulan','tahun']))
                                        <div class="small mt-1">
                                            Tidak ada pengaduan sesuai filter
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="small text-muted text-center mb-2">
                Menampilkan {{ $pengaduans->firstItem() }} – {{ $pengaduans->lastItem() }}
                dari {{ $pengaduans->total() }} pengaduan
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $pengaduans->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection
