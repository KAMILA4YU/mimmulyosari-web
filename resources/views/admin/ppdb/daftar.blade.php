@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- judul halaman -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0">
            Data Pendaftar PPDB
        </h4>
    </div>

    <!-- card wrapped -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">

        <form method="GET" action="{{ route('admin.ppdb.pendaftar') }}"
              class="row g-2 mb-3 align-items-end">

            <!-- status -->
            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="diterima" {{ request('status')=='diterima'?'selected':'' }}>Diterima</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>

            <!-- bulan -->
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

            <!-- tahun -->
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

            <!-- button -->
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-filter"></i> Filter
                </button>

                @if(request()->anyFilled(['status','bulan','tahun']))
                    <a href="{{ route('admin.ppdb.pendaftar') }}" class="btn btn-secondary w-100">
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
                            <th>NIK</th>
                            <th>Nama Orang Tua</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pendaftar as $p)
                        <tr>
                            <td>{{ $pendaftar->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->nik }}</td>

                            <td>
                                <span class="d-block"><strong>Ayah:</strong> {{ $p->nama_ayah }}</span>
                                <span class="d-block"><strong>Ibu:</strong> {{ $p->nama_ibu }}</span>
                            </td>

                            <td>
                                <span class="d-block"><strong>Ayah:</strong> {{ $p->no_hp_ayah }}</span>
                                <span class="d-block"><strong>Ibu:</strong> {{ $p->no_hp_ibu }}</span>
                            </td>

                            {{-- STATUS BADGE --}}
                            <td>
                                @php
                                    $status = $p->status;
                                @endphp

                                <span class="badge rounded-pill px-3 py-2 fw-semibold
                                    @if($status == 'pending') bg-warning text-dark
                                    @elseif($status == 'diterima') bg-success
                                    @elseif($status == 'ditolak') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    
                                    @if($status == 'pending')
                                        <i class="bi bi-hourglass-split me-1"></i> Pending
                                    @elseif($status == 'diterima')
                                        <i class="bi bi-check-circle me-1"></i> Diterima
                                    @elseif($status == 'ditolak')
                                        <i class="bi bi-x-circle me-1"></i> Ditolak
                                    @else
                                        Unknown
                                    @endif
                                </span>
                            </td>

                            <!-- button aksi -->
                            <td class="text-center">
                                <div class="d-grid d-md-flex gap-2 justify-content-center">

                                    <!-- detail -->
                                    <a href="{{ route('admin.ppdb.detail', $p->id) }}"
                                    class="btn btn-info btn-sm aksi-btn">
                                        <i class="bi bi-eye-fill"></i>
                                        <span>Detail</span>
                                    </a>

                                    @if($p->status == 'pending')

                                        <!-- verifikasi -->
                                        <form action="{{ route('admin.ppdb.verifikasi', $p->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm aksi-btn">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <span>Verif</span>
                                            </button>
                                        </form>

                                        <!-- tolak -->
                                        <form action="{{ route('admin.ppdb.tolak', $p->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm aksi-btn">
                                                <i class="bi bi-x-circle-fill"></i>
                                                <span>Tolak</span>
                                            </button>
                                        </form>

                                    @elseif(in_array($p->status, ['ditolak', 'diterima']))
                                    <form action="{{ route('admin.ppdb.undo', $p->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning btn-sm aksi-btn"
                                            onclick="return confirm('Kembalikan status ke PENDING?')">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            <span>Undo</span>
                                        </button>
                                    </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $pendaftar->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
<style>
.aksi-btn {
    width: 110px;        
    height: 38px;        
    padding: 6px 0;
    
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    border-radius: 8px; 
    font-size: 13px;
    font-weight: 500;
    white-space: nowrap;
}

.aksi-btn i {
    font-size: 14px;
}

@media (max-width: 768px) {
    .aksi-btn {
        width: 100%;
    }
}
</style>
@endsection
