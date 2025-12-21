@extends('layouts.admin')

@section('content')

@php
    $allowedTabs = ['identitas', 'visi', 'struktur'];
    $activeTab = request('tab');

    if (!in_array($activeTab, $allowedTabs)) {
        $activeTab = 'identitas';
    }
@endphp

<div class="container-fluid">

    <h4 class="mb-4 fw-bold text-primary">Kelola Profil Sekolah</h4>

    {{-- ========== ALERT SUCCESS ========== --}}
    @if(session('success'))
        <div id="alertSuccess"
            class="alert alert-success alert-dismissible fade show"
            role="alert"
            style="transition: opacity 0.5s ease; font-weight:600;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <script>
            setTimeout(() => {
                const a = document.getElementById('alertSuccess');
                if (a) {
                    a.style.opacity = 0;

                    setTimeout(() => a.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    {{-- ======= NOTIF GURU ======= --}}
    <div id="notifGuru" style="display:none;">
        <div class="alert alert-success alert-dismissible fade show mt-3">
            <span id="notifGuruText"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>

    {{-- TAB NAVIGASI --}}
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="{{ route('admin.profil-sekolah', ['tab' => 'identitas']) }}"
           class="nav-link {{ $activeTab == 'identitas' ? 'active' : '' }}">
            Identitas Sekolah
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.profil-sekolah', ['tab' => 'visi']) }}"
           class="nav-link {{ $activeTab == 'visi' ? 'active' : '' }}">
            Visi & Misi
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.profil-sekolah', ['tab' => 'struktur']) }}"
           class="nav-link {{ $activeTab == 'struktur' ? 'active' : '' }}">
            Struktur / Guru
        </a>
    </li>
</ul>


    {{-- ISI TAB --}}
    <div class="tab-content p-4 bg-white border border-top-0 rounded-bottom shadow-sm">

        {{--  == TAB IDENTITAS  == --}}
        <div class="tab-pane fade {{ $activeTab == 'identitas' ? 'show active' : '' }}">
            <form action="{{ route('admin.profil-sekolah.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tab" value="identitas">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control"
                               value="{{ $profil->nama_sekolah ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">NSM/NPSN</label>
                        <input type="text" name="npsn" class="form-control"
                               value="{{ $profil->npsn ?? '' }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="alamat" class="form-control"
                               value="{{ $profil->alamat ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ $profil->email ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Telepon</label>
                        <input type="text" name="telepon" class="form-control"
                               value="{{ $profil->telepon ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tahun Berdiri</label>
                        <input type="text" name="tahun_berdiri" class="form-control"
                               value="{{ $profil->tahun_berdiri ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Akreditasi</label>
                        <input type="text" name="akreditasi" class="form-control"
                               value="{{ $profil->akreditasi ?? '' }}">
                    </div>

                    {{-- FOTO SEKOLAH DI TAB IDENTITAS --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold">Foto Sekolah</label><br>

                        @if (!empty($profil->foto_sekolah))
                            <img src="{{ asset('storage/' . $profil->foto_sekolah) }}"
                                 width="250" class="rounded shadow mb-3">
                        @endif

                        <input type="file" name="foto_sekolah" class="form-control w-50">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
            </form>
        </div>

        {{--  == TAB VISI & MISI  == --}}
            <div class="tab-pane fade {{ $activeTab == 'visi' ? 'show active' : '' }}">
                <form action="{{ route('admin.profil-sekolah.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="update_type" value="visi_misi">
                    <input type="hidden" name="tab" value="visi">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Visi</label>
                        <textarea name="visi" class="form-control" rows="2">{{ $profil->visi ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Misi</label>
                        <textarea name="misi" class="form-control" rows="4">{{ $profil->misi ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Visi & Misi</button>
                </form>
            </div>


        {{--  == TAB STRUKTUR  == --}}
            <div class="tab-pane fade {{ $activeTab == 'struktur' ? 'show active' : '' }}">
                <p class="text-muted">Silakan upload atau edit data guru</p>

                <!-- BUTTON BUKA MODAL TAMBAH -->
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
                    + Tambah Data Guru
                </button>

                <!--   MODAL TAMBAH GURU   -->
                <div class="modal fade" id="modalTambahGuru" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form id="formTambahGuru" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">Nama Guru</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Foto (Opsional)</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!--   MODAL EDIT GURU   -->
                <div class="modal fade" id="modalEditGuru" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form id="formEditGuru" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="edit_id">

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">Nama Guru</label>
                                        <input type="text" id="edit_nama" name="nama" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" id="edit_jabatan" name="jabatan" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Foto Baru (Opsional)</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <hr>

                {{--   LIST DATA GURU   --}}
                <div class="row" id="listGuru">
                    @forelse ($gurus as $guru)
                        <div class="col-6 col-md-3 col-xl-2 mb-3 guru-col">
                            <div class="card shadow-sm">

                               <img src="{{ $guru->foto_url }}" class="card-img-top guru-img">
                               
                                <div class="card-body text-center">
                                    <h6 class="fw-bold mb-1">{{ $guru->nama }}</h6>
                                    <p class="text-muted mb-2">{{ $guru->jabatan }}</p>

                                    <x-action-buttons>

                                <!-- EDIT -->
                                <button class="btn btn-outline-warning btn-sm btn-action editGuruBtn"
                                    data-id="{{ $guru->id }}"
                                    data-nama="{{ $guru->nama }}"
                                    data-jabatan="{{ $guru->jabatan }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditGuru"
                                    title="Edit Guru">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- HAPUS -->
                                <button class="btn btn-outline-danger btn-sm btn-action hapusGuruBtn"
                                    data-id="{{ $guru->id }}"
                                    title="Hapus Guru">
                                    <i class="bi bi-trash3"></i>
                                </button>

                            </x-action-buttons>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada data guru.</p>
        @endforelse
    </div>
</div>


<script>

function closeModalSafely(modalId){
    const modalEl = document.getElementById(modalId);
    if(modalEl){
        const modal = bootstrap.Modal.getInstance(modalEl);
        if(modal) modal.hide();
    }

    // BERSIHKAN BACKDROP & BODY
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open');
    document.body.style.removeProperty('padding-right');
}

//   TAMBAH GURU  
document.getElementById('formTambahGuru').addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('admin.guru.store') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: formData
        })
    .then(res => res.json())
    .then(res => {
        if(res.success){

            const modalEl = document.getElementById('modalTambahGuru');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            // 🔔 TAMPILKAN ALERT SUCCESS
            document.getElementById("notifGuruText").innerText = "Guru berhasil ditambahkan!";
            document.getElementById("notifGuru").style.display = "block";

            // ⏳ AUTO RELOAD
            setTimeout(() => location.reload(), 1200);
        }
    });
});


//   ISI DATA KE MODAL EDIT  
document.querySelectorAll('.editGuruBtn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.getElementById('edit_id').value = this.dataset.id;
        document.getElementById('edit_nama').value = this.dataset.nama;
        document.getElementById('edit_jabatan').value = this.dataset.jabatan;
    });
});


//   UPDATE GURU  
document.getElementById('formEditGuru').addEventListener('submit', function(e){
    e.preventDefault();

    let id = document.getElementById('edit_id').value;
    let formData = new FormData(this);

    fetch(`/admin/guru/${id}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "X-HTTP-Method-Override": "PUT"
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){

            // 🔥 TUTUP MODAL DENGAN AMAN
            closeModalSafely('modalEditGuru');

            // 🔔 ALERT SUCCESS
            document.getElementById("notifGuruText").innerText = "Data guru berhasil diperbarui!";
            document.getElementById("notifGuru").style.display = "block";

            // ⏳ RELOAD
            setTimeout(() => location.reload(), 1200);
        }
    });
});


//   HAPUS GURU  
document.querySelectorAll('.hapusGuruBtn').forEach(btn => {
    btn.addEventListener('click', function () {
        if(!confirm("Yakin ingin menghapus guru ini?")) return;

        fetch(`/admin/guru/${this.dataset.id}`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
        })
        .then(res => res.json())
        .then(res => {
            if(res.success){

                // JAGA-JAGA BACKDROP NYANGKUT
                closeModalSafely(); 

                // 🔔 ALERT SUCCESS
                document.getElementById("notifGuruText").innerText = "Guru berhasil dihapus!";
                document.getElementById("notifGuru").style.display = "block";

                setTimeout(() => location.reload(), 1200);
            }
        });
    });
});

</script>
    </div>
</div>

<style>
    .guru-img {
        width: 100%;
        aspect-ratio: 3 / 4;       
        object-fit: cover;   
        object-position: top; 
    }
    @media (max-width: 576px) {
        .guru-img {
            aspect-ratio: 1 / 1; 
        }

        .card-body h6 {
            font-size: 0.9rem;
        }

        .card-body p {
            font-size: 0.8rem;
        }
    }
</style>

@endsection
