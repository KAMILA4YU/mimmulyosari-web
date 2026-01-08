@extends('layouts.user')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4"><i class="bi bi-person-circle me-2"></i> Profil Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('user.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-4 text-center">

                        <div class="position-relative d-inline-block">

                        <img id="previewFoto"
                            data-original="{{ $user->foto
                                ? asset('foto_user/' . $user->foto)
                                : asset('img/default-user.jpg') }}"
                            src="{{ $user->foto
                                ? asset('foto_user/' . $user->foto)
                                : asset('img/default-user.jpg') }}"
                            class="rounded-circle shadow"
                            width="150" height="150"
                            style="object-fit:cover;">

                        <!-- edit -->
                        <label for="foto"
                            class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:36px; height:36px; cursor:pointer;">
                            <i class="bi bi-pencil"></i>
                        </label>

                        <!-- delete -->
                        @if($user->foto)
                        <button type="button"
                            class="position-absolute bottom-0 start-0 bg-danger text-white rounded-circle border-0"
                            style="width:36px; height:36px;"
                            onclick="hapusFoto()">
                            <i class="bi bi-trash"></i>
                        </button>
                        @endif

                        <button type="button"
                            id="undoBtn"
                            class="position-absolute top-0 end-0 bg-secondary text-white rounded-circle border-0 d-none"
                            style="width:36px; height:36px;"
                            onclick="undoPreview()">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>

                    </div>

                    <input type="file"
                        name="foto"
                        id="foto"
                        class="d-none"
                        accept="image/*"
                        onchange="previewImage(this)">

                    </div>

                    <div class="col-md-8">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ $user->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ $user->email }}">
                        </div>

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

                        <button class="btn btn-primary px-4">
                            <i class="bi bi-save me-2"></i> Simpan Perubahan
                        </button>

                    </div>
                </div>

            </form>
            <form id="hapusFotoForm" action="{{ route('user.profil.hapus-foto') }}" method="POST">
                @csrf
                @method('DELETE')
            </form>

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
function hapusFoto() {
    if (confirm('Yakin ingin menghapus foto profil?')) {
        document.getElementById('hapusFotoForm').submit();
    }
}
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const img = document.getElementById('previewFoto');
        const undoBtn = document.getElementById('undoBtn');

        reader.onload = function (e) {
            img.src = e.target.result;
            undoBtn.classList.remove('d-none');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function undoPreview() {
    const img = document.getElementById('previewFoto');
    const undoBtn = document.getElementById('undoBtn');
    const fileInput = document.getElementById('foto');

    img.src = img.dataset.original;
    fileInput.value = ''; // reset file input
    undoBtn.classList.add('d-none');
}
</script>
@endsection
