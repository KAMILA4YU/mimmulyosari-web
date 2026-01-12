@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <h4 class="mb-4 fw-bold text-primary">Pengaturan Halaman Beranda</h4>

    @if(session('success'))
        <div id="alertSuccess" class="alert alert-success alert-dismissible fade show" role="alert" style="transition: opacity .4s; font-weight:600;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('alertSuccess');
                if(alertBox){ alertBox.style.opacity = 0; setTimeout(() => alertBox.remove(), 400); }
            }, 2500);
        </script>
    @endif

    @php
    $tab = request('tab', 'hero');
@endphp

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="{{ route('admin.home-section.edit') }}?tab=hero"
           class="nav-link {{ $tab == 'hero' ? 'active' : '' }}">
            Halaman Utama
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.home-section.edit') }}?tab=sambutan"
           class="nav-link {{ $tab == 'sambutan' ? 'active' : '' }}">
            Sambutan
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.home-section.edit') }}?tab=tentang"
           class="nav-link {{ $tab == 'tentang' ? 'active' : '' }}">
            Tentang Kami
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.home-section.edit') }}?tab=sosial"
           class="nav-link {{ $tab == 'sosial' ? 'active' : '' }}">
            Media Sosial
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.home-section.edit') }}?tab=ppdb-info"
           class="nav-link {{ $tab == 'ppdb-info' ? 'active' : '' }}">
            Info PPDB
        </a>
    </li>
</ul>


    <form action="{{ route('admin.home-section.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tab" value="{{ $tab }}">

        <div class="tab-content p-4 bg-white border border-top-0 rounded-bottom shadow-sm">

            <!-- HERO SECTION -->
            <div class="tab-pane fade {{ $tab == 'hero' ? 'show active' : '' }}" id="hero">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" name="judul_hero" class="form-control" value="{{ $home->judul_hero }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Subjudul</label>
                        <input type="text" name="subjudul_hero" class="form-control" value="{{ $home->subjudul_hero }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Slogan / Deskripsi</label>
                        <textarea name="slogan_hero" rows="3" class="form-control">{{ $home->slogan_hero }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Gambar/Background</label>
                        <input type="file" name="gambar_hero" class="form-control">
                        @if($home->gambar_hero)
                        <img src="{{ asset('storage/'.$home->gambar_hero) }}" class="img-fluid rounded shadow-sm mt-2" style="max-height:150px; object-fit:cover;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- SAMBUTAN -->
            <div class="tab-pane fade {{ $tab == 'sambutan' ? 'show active' : '' }}" id="sambutan">
                <label class="form-label fw-semibold">Judul</label>
                <input type="text" name="judul_sambutan" class="form-control mb-3" value="{{ $home->judul_sambutan }}">

                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi_sambutan" rows="4" class="form-control mb-3">{{ $home->deskripsi_sambutan }}</textarea>

                <label class="form-label fw-semibold">Gambar</label>
                <input type="file" name="gambar_sambutan" class="form-control">
                @if($home->gambar_sambutan)
                    <img src="{{ asset('storage/'.$home->gambar_sambutan) }}" class="img-fluid rounded shadow-sm mt-2" style="max-height:150px;">
                @endif
            </div>

            <!-- TENTANG KAMI -->
            <div class="tab-pane fade {{ $tab == 'tentang' ? 'show active' : '' }}" id="tentang">
                <label class="form-label fw-semibold">Judul</label>
                <input type="text" name="judul_tentang" class="form-control mb-3" value="{{ $home->judul_tentang }}">

                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi_tentang" rows="4" class="form-control mb-3">{{ $home->deskripsi_tentang }}</textarea>

                <!-- <label class="form-label fw-semibold">Gambar</label>
                <input type="file" name="gambar_tentang" class="form-control">
                @if($home->gambar_tentang)
                    <img src="{{ asset('storage/'.$home->gambar_tentang) }}" class="img-fluid rounded shadow-sm mt-2" style="max-height:150px;">
                @endif -->
            </div>

            <!-- MEDIA SOSIAL -->
            <div class="tab-pane fade {{ $tab == 'sosial' ? 'show active' : '' }}" id="sosial">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="{{ $home->facebook }}" placeholder="Link Facebook">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="{{ $home->instagram }}" placeholder="Link Instagram">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">YouTube</label>
                        <input type="text" name="youtube" class="form-control" value="{{ $home->youtube }}" placeholder="Link YouTube">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Twitter</label>
                        <input type="text" name="twitter" class="form-control" value="{{ $home->twitter }}" placeholder="Link Twitter">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control" value="{{ $home->whatsapp }}" placeholder="Nomor WhatsApp">
                    </div>
                </div>
            </div>

            <!-- INFO PPDB -->
            <div class="tab-pane fade {{ $tab == 'ppdb-info' ? 'show active' : '' }}" id="ppdb-info">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status PPDB</label>
                    <select name="ppdb_status" class="form-select">
                        <option value="dibuka" {{ $home->ppdb_status == 'dibuka' ? 'selected' : '' }}>Dibuka</option>
                        <option value="ditutup" {{ $home->ppdb_status == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Periode</label>
                    <input type="text" name="ppdb_periode" class="form-control"
                        value="{{ $home->ppdb_periode }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gelombang</label>
                    <input type="text" name="ppdb_gelombang" class="form-control"
                        value="{{ $home->ppdb_gelombang }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <textarea name="ppdb_keterangan" class="form-control"
                            rows="3">{{ $home->ppdb_keterangan }}</textarea>
                </div>

            </div>

        </div>

        <div class="text-end mt-3">
            <button class="btn btn-primary px-4 btn-lg">Simpan Perubahan</button>
        </div>

    </form>
</div>
@endsection
