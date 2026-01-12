@extends('layouts.user')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="mb-4">
        <h4 class="fw-bold d-flex align-items-center gap-2">
            <i class="bi bi-chat-left-text text-primary"></i>
            Detail Pengaduan
        </h4>
        <p class="text-muted mb-0">Lihat pesan dan balasan dari admin.</p>
    </div>

    <!-- Card Utama -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <!-- Judul & Isi Pengaduan -->
            <h5 class="fw-bold mb-2">{{ $pengaduan->subjek }}</h5>
            <p class="text-secondary">{{ $pengaduan->pesan }}</p>

            <!-- Status Pengaduan -->
            <div class="mt-3">
                <small class="fw-semibold">Status:</small>
                @if($pengaduan->status == 'Menunggu')
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                        <i class="bi bi-hourglass-split me-1"></i> Menunggu
                    </span>
                @elseif($pengaduan->status == 'Diproses')
                    <span class="badge bg-info text-dark rounded-pill px-3 py-2">
                        <i class="bi bi-gear-fill me-1"></i> Diproses
                    </span>
                @else
                    <span class="badge bg-success rounded-pill px-3 py-2">
                        <i class="bi bi-check-circle-fill me-1"></i> Selesai
                    </span>
                @endif
            </div>

            <hr class="my-4">

            <!-- Balasan Admin -->
            <h6 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-reply-fill text-success"></i>
                Balasan Admin
            </h6>

            @forelse($pengaduan->balasans as $balas)
                <div class="p-3 mb-3 rounded-4"
                     style="background: #e9f7ef; border-left: 4px solid #28a745;">
                    <div class="fw-medium">{{ $balas->isi }}</div>
                    <small class="text-muted d-block mt-1">
                        <i class="bi bi-clock me-1"></i>
                        {{ $balas->created_at->format('d M Y H:i') }}
                    </small>
                </div>
            @empty
                <p class="text-muted fst-italic">Belum ada balasan dari admin.</p>
            @endforelse

            <!-- Tombol Kembali -->
            <a href="{{ route('user.pengaduan.index') }}"
               class="btn btn-outline-secondary rounded-pill mt-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>

        </div>
    </div>

</div>
@endsection
