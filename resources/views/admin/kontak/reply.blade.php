@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">
        <i class="bi bi-reply-fill me-2"></i> Balas Pesan Kontak
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <p class="mb-0"><strong>Nama:</strong> {{ $kontak->nama }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-0"><strong>Email:</strong> {{ $kontak->email }}</p>
                </div>
            </div>

            <div class="mb-3">
                <p><strong>Subjek:</strong> {{ $kontak->subjek }}</p>
                <p><strong>Pesan:</strong> {{ $kontak->pesan }}</p>
            </div>

            @if($kontak->balasan)
                <div class="alert alert-secondary">
                    <strong>Balasan sebelumnya:</strong>
                    <p class="mb-0">{{ $kontak->balasan }}</p>
                </div>
            @endif

            <form action="{{ route('admin.kontak.sendReply', $kontak->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="balasan" class="form-label">Balasan untuk Pengirim</label>
                    <textarea name="balasan" id="balasan" class="form-control" rows="5" required>{{ $kontak->balasan ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary px-4">Kirim Balasan</button>
            </form>

        </div>
    </div>
    <a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary mt-3">
        ← Kembali
    </a>

</div>
@endsection
