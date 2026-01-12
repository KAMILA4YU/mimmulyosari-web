@extends('layouts.admin')

@section('content')

@php
    $allowedTabs = ['pengumuman', 'agenda'];
    $activeTab = in_array(request('tab'), $allowedTabs)
        ? request('tab')
        : 'pengumuman';
@endphp

<div class="container-fluid">

    <!-- ========================= TITLE ========================== -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0">
            Manajemen Informasi Sekolah
        </h4>
    </div>

    <!-- ========================= ALERT ========================== -->
    @if(session('success'))
        <div id="alertSuccess"
            class="alert alert-success alert-dismissible fade show"
            role="alert"
            style="transition: opacity .5s ease;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <script>
            setTimeout(() => {
                const alertEl = document.getElementById('alertSuccess');
                if(alertEl){
                    alertEl.style.opacity = 0;
                    setTimeout(() => alertEl.remove(), 500);
                }
            }, 2500);
        </script>
    @endif

    <!-- ========================= TAB MENU ========================== -->
    <ul class="nav nav-tabs shadow-sm">
    <li class="nav-item">
        <a href="{{ route('admin.informasi', ['tab' => 'pengumuman']) }}"
           class="nav-link {{ $activeTab == 'pengumuman' ? 'active' : '' }}">
            Pengumuman
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.informasi', ['tab' => 'agenda']) }}"
           class="nav-link {{ $activeTab == 'agenda' ? 'active' : '' }}">
            Agenda Kegiatan
        </a>
    </li>
</ul>


    <!-- ========================= TAB CONTENT ========================== -->
    <div class="tab-content mt-4">

        <!-- ===================== TAB PENGUMUMAN ===================== -->
        <div class="tab-pane fade {{ $activeTab == 'pengumuman' ? 'show active' : '' }}"
             id="pengumuman">
            @include('admin.partials.informasi-tab', [
                'title' => 'Daftar Pengumuman',
                'kategori' => 'pengumuman',
                'data' => $pengumuman
            ])
        </div>

        <!-- ===================== TAB AGENDA ===================== -->
        <div class="tab-pane fade {{ $activeTab == 'agenda' ? 'show active' : '' }}"
             id="agenda">
            @include('admin.partials.informasi-tab', [
                'title' => 'Agenda Kegiatan',
                'kategori' => 'agenda',
                'data' => $agenda
            ])
        </div>

        <!-- MODAL TAMBAH -->
        <div class="modal fade" id="modalInformasi" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Informasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="informasiForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="kategori" id="kategoriInput">
                <input type="hidden" name="id" id="informasiId">

                <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi</label>
                    <textarea class="form-control" name="isi" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (opsional)</label>
                    <input type="file" name="gambar" class="form-control">
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

        <script>
        function createInformasi(kategori) {
            document.getElementById('kategoriInput').value = kategori;
            document.getElementById('modalTitle').innerText = 'Tambah ' + kategori;
        }

        function openEditModal(button) {
            const kategori = button.closest('[data-kategori]')?.dataset.kategori;

            document.getElementById('editActiveTab').value = kategori;

            const id = button.dataset.id;
            const judul = button.dataset.judul;
            const tanggal = button.dataset.tanggal;
            const isi = button.dataset.isi;

            const editModal = document.getElementById('modalEditInformasi');
            editModal.addEventListener('hidden.bs.modal', () => {
                document.activeElement.blur();
            });
            
            const form = document.getElementById('formEditInformasi');
            form.action = "{{ url('admin/informasi') }}/" + id;

            document.getElementById('editJudul').value = judul;
            document.getElementById('editTanggal').value = tanggal ?? '';
            document.getElementById('editIsi').value = isi;
        }
        </script>
        
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="modalEditInformasi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Edit Informasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form id="formEditInformasi" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="active_tab" id="editActiveTab">
            @csrf
            @method('PUT')

            <div class="modal-body">

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" id="editJudul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="editTanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi</label>
                <textarea name="isi" id="editIsi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar (opsional)</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Update</button>
            </div>

        </form>

        </div>
    </div>
    </div>

</div>
@endsection
