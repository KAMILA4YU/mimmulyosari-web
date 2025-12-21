@extends('layouts.user')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Buat Pengaduan Baru</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.pengaduan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Subjek Pengaduan</label>
                    <input type="text" 
                           name="subjek" 
                           value="{{ old('subjek') }}"
                           class="form-control @error('subjek') is-invalid @enderror"
                           placeholder="Masukkan subjek pengaduan..."
                           required>
                    @error('subjek')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Pengaduan</label>
                    <textarea name="pesan" 
                              class="form-control @error('pesan') is-invalid @enderror"
                              rows="5"
                              placeholder="Tuliskan keluhan atau laporan Anda..."
                              required>{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('user.pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
