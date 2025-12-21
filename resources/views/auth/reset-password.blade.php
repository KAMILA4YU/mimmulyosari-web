<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg p-4 rounded-4">
                    <h3 class="text-center mb-3 fw-bold">
                        Reset Password
                    </h3>

                    <p class="text-muted text-center mb-4" style="font-size: 0.95rem;">
                        Silakan masukkan password baru untuk akun kamu.
                    </p>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control rounded-pill bg-light"
                                   value="{{ old('email', $request->email) }}"
                                   readonly>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password"
                                   name="password"
                                   class="form-control rounded-pill"
                                   required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control rounded-pill"
                                   required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
                            Reset Password
                        </button>

                        <p class="text-center mt-3 mb-0">
                            <a href="{{ route('login') }}" class="text-decoration-none small">
                                Kembali ke Login
                            </a>
                        </p>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-guest-layout>

<style>
    body {
        background: linear-gradient(135deg, #f0f4ff, #dfe9f3);
    }
    .card {
        border: none;
    }
    .btn-primary {
        background: linear-gradient(90deg, #007bff, #4a90e2);
        border: none;
        transition: 0.3s ease;
    }
    .btn-primary:hover {
        transform: scale(1.03);
        background: linear-gradient(90deg, #4a90e2, #007bff);
    }
</style>
