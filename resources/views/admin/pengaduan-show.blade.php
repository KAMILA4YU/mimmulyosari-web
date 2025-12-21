@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h4 class="fw-bold text-primary mb-4">
        Detail Pengaduan
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Detail Pengaduan --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">{{ $pengaduan->subjek }}</h5>
            
            <p><strong>User:</strong> {{ $pengaduan->user->name }}</p>
            <p><strong>Pesan:</strong> {{ $pengaduan->pesan }}</p>
            <p>
                <strong>Status:</strong>
                @if($pengaduan->status == 'Menunggu')
                    <span class="badge bg-warning text-dark">Menunggu</span>
                @elseif($pengaduan->status == 'Diproses')
                    <span class="badge bg-info text-dark">Diproses</span>
                @elseif($pengaduan->status == 'Selesai')
                    <span class="badge bg-success">Selesai</span>
                @endif
            </p>

            {{-- Form update status --}}
            <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST" class="d-flex align-items-center gap-2 mt-3 flex-wrap">
                @csrf @method('PUT')
                <select name="status" class="form-select w-auto">
                    <option value="Menunggu" {{ $pengaduan->status=='Menunggu'?'selected':'' }}>Menunggu</option>
                    <option value="Diproses" {{ $pengaduan->status=='Diproses'?'selected':'' }}>Diproses</option>
                    <option value="Selesai" {{ $pengaduan->status=='Selesai'?'selected':'' }}>Selesai</option>
                </select>
                <button type="submit" class="btn btn-success">Update Status</button>
            </form>
        </div>
    </div>

    {{-- Balasan --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Balasan</h5>

            @if($pengaduan->balasans->isEmpty())
                <p class="text-muted">Belum ada balasan.</p>
            @else
                <ul class="list-unstyled">
                    @foreach($pengaduan->balasans as $balasan)
                        <li class="mb-2 p-2 border rounded bg-light">
                            {{ $balasan->isi }}
                            <br>
                            <small class="text-muted">{{ $balasan->created_at->format('d M Y, H:i') }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- Form kirim balasan --}}
            <form action="{{ route('admin.pengaduan.balas', $pengaduan->id) }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-3">
                    <textarea name="isi" class="form-control" rows="3" placeholder="Tulis balasan..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Balasan</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary mt-3">
        ← Kembali
    </a>

</div>
@endsection
