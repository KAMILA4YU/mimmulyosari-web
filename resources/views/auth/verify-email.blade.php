<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-5 rounded-4 text-center border-0" style="background: #f8f9fa;">

                    <!-- LOGO -->
                    <div class="mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah" width="100" class="mb-2">
                        <h2 class="fw-bold text-primary mb-0">MI Muhammadiyah Mulyosari</h2>
                    </div>

                    <!-- ICON -->
                    <div class="mb-3">
                        <i class="bi bi-envelope-check-fill text-success fs-1"></i>
                    </div>

                    <h4 class="fw-bold mb-3">Verifikasi Email</h4>

                    <p class="text-muted mb-4" style="line-height: 1.6;">
                        Kami sudah mengirimkan <b>link verifikasi</b> ke email kamu.<br>
                        Silakan cek <b>Inbox</b> atau <b>Spam</b>, lalu klik link untuk melanjutkan.
                    </p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success py-2">
                            Link verifikasi baru berhasil dikirim ke email kamu.
                        </div>
                    @endif

                    <p class="text-muted small mb-4">
                        Email terdaftar: <b>{{ auth()->user()->email }}</b>
                    </p>

                    <div class="d-grid gap-3">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold">
                                <i class="bi bi-arrow-repeat me-2"></i> Kirim Ulang Email Verifikasi
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-lg rounded-pill fw-bold">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </div>

                    <p class="text-muted small mt-4">
                        Jika kamu tidak membuat akun ini, abaikan halaman ini.
                    </p>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
