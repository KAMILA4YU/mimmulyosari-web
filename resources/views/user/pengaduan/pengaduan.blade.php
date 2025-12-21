@extends('layouts.user')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
        <h2 class="fw-bold m-0">
            <i class="bi bi-chat-dots me-2"></i> Pengaduan Saya
        </h2>
        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary shadow-sm px-4 py-2">
            + Buat Pengaduan Baru
        </a>
    </div>

    @if($pengaduans->count())
        <div class="row g-4">
            @foreach($pengaduans as $aduan)
            <div class="col-12 col-sm-6 col-lg-4">

                <a href="{{ route('user.pengaduan.show', $aduan->id) }}" class="text-decoration-none">

                    <div class="card pengaduan-card h-100 shadow-sm border-0">
                        <div class="card-body">

                            {{-- Judul --}}
                            <h5 class="fw-semibold text-dark mb-2">{{ $aduan->subjek }}</h5>

                            {{-- Preview Pesan --}}
                            <p class="text-muted small mb-3" style="min-height: 50px;">
                                {{ Str::limit($aduan->pesan, 85) }}
                            </p>

                            {{-- Status --}}
                            @if($aduan->status == 'Menunggu')
                                <span class="status-badge waiting">
                                    <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                </span>
                            @elseif($aduan->status == 'Diproses')
                                <span class="status-badge processing">
                                    <i class="bi bi-gear-wide-connected me-1"></i> Diproses
                                </span>
                            @else
                                <span class="status-badge done">
                                    <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                </span>
                            @endif

                            {{-- Tanggal --}}
                            <div class="text-end small text-muted mt-3">
                                {{ $aduan->created_at->format('d M Y') }}
                            </div>

                        </div>
                    </div>

                </a>

            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-light text-center p-4 shadow-sm rounded-4">
            Belum ada pengaduan yang dibuat.
        </div>
    @endif

</div>

{{-- STYLE IMPROVEMENT --}}
<style>
    /* Card */
    .pengaduan-card {
        border-radius: 14px;
        transition: .25s ease;
        background: #ffffff;
    }
    .pengaduan-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.08);
    }

    /* Badges */
    .status-badge {
        padding: 4px 10px;
        font-size: 0.75rem;
        border-radius: 8px;
        font-weight: 600;
    }

    .waiting {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffe69c;
    }

    .processing {
        background: #cff4fc;
        color: #055160;
        border: 1px solid #b6effb;
    }

    .done {
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #a3cfbb;
    }

    /* Responsive tweaks */
    @media (max-width: 576px) {
        h2 {
            font-size: 1.4rem;
        }
        .pengaduan-card {
            border-radius: 12px;
        }
    }
</style>
@endsection
