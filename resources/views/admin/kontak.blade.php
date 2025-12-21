@extends('layouts.admin')

@php
    $activeTab = request('tab', 'info');
@endphp

@section('content')
<div class="container">

    <h4 class="fw-bold text-primary mb-4">
        Manajemen Kontak
    </h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

    <!-- NAV TABS -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a href="{{ route('admin.kontak.index', ['tab' => 'info']) }}"
            class="nav-link {{ $activeTab == 'info' ? 'active' : '' }}">
                Info Kontak Sekolah
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.kontak.index', ['tab' => 'pesan']) }}"
            class="nav-link {{ $activeTab == 'pesan' ? 'active' : '' }}">
                Pesan Pengunjung
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- TAB 1: INFO KONTAK -->
        <div class="tab-pane fade {{ $activeTab == 'info' ? 'show active' : '' }}"
             id="info" role="tabpanel">
            <div class="card p-4 shadow-sm mb-4">
                <h5 class="fw-bold mb-3">Edit Info Kontak Sekolah</h5>

                <form action="{{ route('admin.info-kontak.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ $info->alamat ?? '' }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input name="email" class="form-control" value="{{ $info->email ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Telepon</label>
                            <input name="telepon" class="form-control" value="{{ $info->telepon ?? '' }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Website</label>
                            <input name="website" class="form-control" value="{{ $info->website ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jam Operasional</label>
                            <input name="jam_operasional" class="form-control" value="{{ $info->jam_operasional ?? '' }}">
                        </div>
                    </div>

                    <button class="btn btn-primary px-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>

        <!-- TAB 2: PESAN PENGUNJUNG -->
        <div class="tab-pane fade {{ $activeTab == 'pesan' ? 'show active' : '' }}"
             id="pesan" role="tabpanel">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold">Daftar Pesan Pengunjung</h5>

                <form method="GET" class="d-flex gap-2">
                    <input type="hidden" name="tab" value="pesan">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>
                            Baru
                        </option>
                        <option value="dibaca" {{ request('status') == 'dibaca' ? 'selected' : '' }}>
                            Dibaca
                        </option>
                        <option value="dibalas" {{ request('status') == 'dibalas' ? 'selected' : '' }}>
                            Dibalas
                        </option>
                    </select>

                    <select name="bulan" class="form-select form-select-sm">
                        <option value="">Semua Bulan</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
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
                    @if(request()->anyFilled(['bulan','tahun','status']))
                        <a href="{{ route('admin.kontak.index', ['tab' => 'pesan']) }}"
                        class="btn btn-sm btn-secondary">
                            Reset Filter
                        </a>
                    @endif
                </form>
            </div>

            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Subjek</th>
                            <th>Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kontaks as $kontak)
                            <tr>
                                <td>{{ $kontak->id }}</td>
                                <td>{{ $kontak->nama }}</td>
                                <td>{{ $kontak->email }}</td>

                                <td class="text-center">
                                    @if($kontak->status === 'baru')
                                        <span class="badge bg-danger">Baru</span>
                                    @elseif($kontak->status === 'dibaca')
                                        <span class="badge bg-warning text-dark">Dibaca</span>
                                    @else
                                        <span class="badge bg-success">Dibalas</span>
                                    @endif
                                </td>

                                <td>{{ $kontak->subjek }}</td>

                                <td>
                                    <div class="text-muted" title="{{ $kontak->pesan }}">
                                        {{ \Illuminate\Support\Str::limit($kontak->pesan, 80) }}
                                    </div>

                                    @if($kontak->balasan)
                                        <div class="mt-2 p-2 bg-light border rounded">
                                            <strong>Balasan Admin:</strong>
                                            <p class="mb-0 text-muted"
                                            title="{{ $kontak->balasan }}">
                                                {{ \Illuminate\Support\Str::limit($kontak->balasan, 60) }}
                                            </p>
                                        </div>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex flex-column gap-2">

                                        {{-- BALAS --}}
                                        <a href="{{ route('admin.kontak.reply', [
                                                'id' => $kontak->id,
                                                'tab' => 'pesan'
                                            ]) }}"
                                        class="btn btn-outline-info btn-sm d-flex align-items-center justify-content-center gap-1"
                                        title="Balas Pesan">
                                            <i class="bi bi-reply-fill"></i>
                                            <span class="d-none d-md-inline">Balas</span>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('admin.kontak.destroy', $kontak->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin mau dihapus?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    title="Hapus Pesan">
                                                <i class="bi bi-trash3"></i>
                                                <span class="d-none d-md-inline">Hapus</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <strong>Belum ada pesan</strong>
                                    @if(request('bulan') || request('tahun') || request('status'))
                                        <div class="small mt-1">
                                            Tidak ada pesan sesuai filter yang dipilih
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $kontaks->appends([
                    'tab' => 'pesan',
                    'status' => request('status'),
                    'bulan' => request('bulan'),
                    'tahun' => request('tahun'),
                ])->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
</div>
@endsection
