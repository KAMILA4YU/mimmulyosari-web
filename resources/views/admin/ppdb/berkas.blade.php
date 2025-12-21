@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{--   JUDUL HALAMAN   --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0">
            Semua Berkas Pendaftar
        </h4>
    </div>

    {{--  CARD LIST BERKAS   --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <a href="{{ route('admin.ppdb.cetak-semua', request()->only(['bulan','tahun'])) }}"
            class="btn btn-danger mb-3">
                Cetak Semua Pendaftar Sesuai Filter
            </a>

            <form method="GET" action="{{ route('admin.ppdb.berkas') }}"
                class="row g-2 mb-3 align-items-end">

                {{-- BULAN --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Bulan</label>
                    <select name="bulan" class="form-select">
                        <option value="">Semua Bulan</option>
                        @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}" {{ request('bulan')==$i?'selected':'' }}>
                                {{ \Carbon\Carbon::create()->month($i)->locale('id')->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- TAHUN --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tahun</label>
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @for($y = now()->year; $y >= now()->year - 5; $y--)
                            <option value="{{ $y }}" {{ request('tahun')==$y?'selected':'' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- BUTTON --}}
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>

                    @if(request()->anyFilled(['bulan','tahun']))
                        <a href="{{ route('admin.ppdb.berkas') }}"
                        class="btn btn-secondary w-100">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
    @forelse ($pendaftar as $p)
        <tr>
            <td>{{ $loop->iteration + ($pendaftar->currentPage() - 1) * $pendaftar->perPage() }}</td>

            <td class="fw-semibold">{{ $p->nama_lengkap }}</td>

            <td>
                @php
                    $wajibLengkap = $p->akta_kelahiran && $p->kartu_keluarga && $p->ijazah_tk && $p->foto_siswa;
                @endphp

                @if($wajibLengkap)
                    <span class="badge bg-success">Lengkap</span>
                @else
                    <span class="badge bg-danger">Kurang</span>
                @endif
            </td>

            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.ppdb.detail', $p->id) }}"
                        class="btn btn-sm btn-primary">
                        <i class="bi bi-file-earmark-text"></i> Detail
                    </a>

                    <a href="{{ route('admin.ppdb.cetak', $p->id) }}"
                        class="btn btn-sm btn-success">
                        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center py-5 text-muted">
                <i class="bi bi-folder-x fs-2 mb-2 d-block"></i>
                <strong>Belum ada pendaftar yang diterima</strong><br>
                <span class="small">
                    Data akan muncul setelah pendaftar diverifikasi.
                </span>
            </td>
        </tr>
    @endforelse
</tbody>


                </table>
            </div>

            <div class="mt-3">
                {{ $pendaftar->links() }}
            </div>

        </div>

    </div>
        <div class="alert alert-warning mt-3 small">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Perhatian:</strong>
            Gunakan filter <em>bulan</em> dan/atau <em>tahun</em> terlebih dahulu agar
            <strong>PDF yang dicetak sesuai dengan data yang diinginkan</strong>.
        </div>
</div>
@endsection
