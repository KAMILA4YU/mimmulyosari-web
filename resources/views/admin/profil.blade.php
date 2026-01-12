@extends('layouts.admin')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">

    <h4 class="fw-bold mb-4 text-primary">Profil Admin</h4>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row gy-4">

        <!-- KARTU PROFIL -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 p-4 text-center h-100">

                <!-- Foto -->
                <div class="d-flex justify-content-center mb-3">
                    <div class="position-relative d-inline-block">

                    <img id="previewAdminFoto"
                        data-original="{{ fotoProfil($admin, 'admin') }}"
                        src="{{ fotoProfil($admin, 'admin') }}"
                        class="rounded-circle shadow-sm"
                        style="width:150px;height:150px;object-fit:cover;">

                    <!-- EDIT -->
                    <label for="foto"
                        class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                        style="width:36px; height:36px; cursor:pointer;">
                        <i class="bi bi-pencil"></i>
                    </label>

                    <!-- DELETE -->
                    @if($admin->foto)
                    <button type="button"
                        class="position-absolute bottom-0 start-0 bg-danger text-white rounded-circle border-0"
                        style="width:36px; height:36px;"
                        onclick="hapusFotoAdmin()">
                        <i class="bi bi-trash"></i>
                    </button>
                    @endif

                    <!-- UNDO -->
                    <button type="button"
                        id="undoAdminBtn"
                        class="position-absolute top-0 end-0 bg-secondary text-white rounded-circle border-0 d-none"
                        style="width:36px; height:36px;"
                        onclick="undoAdminPreview()">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>

                </div>

                </div>

                <h5 class="fw-bold mb-1">{{ $admin->name }}</h5>
                <p class="text-muted mb-2">{{ $admin->email }}</p>

                <hr class="my-3">

                <p class="small text-muted mb-0">
                    Administrator Website<br>
                    Memiliki akses penuh untuk mengelola seluruh fitur.
                </p>
            </div>
        </div>

        <!-- FORM EDIT -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Edit Profil</h5>

                    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="file"
                            name="foto"
                            id="foto"
                            class="d-none"
                            accept="image/*"
                            onchange="previewAdminImage(this)">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $admin->name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $admin->email) }}" required>
                        </div>

                        <!-- Password Baru -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                    class="form-control"
                                    placeholder="Kosongkan jika tidak ingin mengganti password">
                                <span class="input-group-text bg-white"
                                    style="cursor:pointer"
                                    onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye text-dark"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control"
                                    placeholder="Ulangi password baru">
                                <span class="input-group-text bg-white"
                                    style="cursor:pointer"
                                    onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye text-dark"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Foto -->
                        <!-- <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Profil</label>
                            <input type="file" name="foto" class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div> -->

                        <!-- Tombol -->
                        <button class="btn btn-primary px-4" type="submit">
                            Simpan Perubahan
                        </button>
                    </form>
                    <form id="hapusFotoAdminForm"
                        action="{{ route('admin.profil.hapus-foto') }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                    </form>


                </div>
            </div>
        </div>

    </div>
</div>

<script>
function togglePassword(inputId, el) {
    const input = document.getElementById(inputId);
    const icon = el.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace('bi-eye', 'bi-eye-slash');
        icon.classList.replace('text-secondary', 'text-primary');
    } else {
        input.type = "password";
        icon.classList.replace('bi-eye-slash', 'bi-eye');
        icon.classList.replace('text-primary', 'text-secondary');
    }
}
function previewAdminImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const img = document.getElementById('previewAdminFoto');
        const undoBtn = document.getElementById('undoAdminBtn');

        reader.onload = function (e) {
            img.src = e.target.result;
            undoBtn.classList.remove('d-none');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function undoAdminPreview() {
    const img = document.getElementById('previewAdminFoto');
    const undoBtn = document.getElementById('undoAdminBtn');
    const input = document.getElementById('foto');

    img.src = img.dataset.original;
    input.value = '';
    undoBtn.classList.add('d-none');
}

function hapusFotoAdmin() {
    if (confirm('Yakin ingin menghapus foto profil admin?')) {
        document.getElementById('hapusFotoAdminForm').submit();
    }
}
</script>

@endsection
