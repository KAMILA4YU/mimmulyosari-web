<x-guest-layout>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <div class="card shadow-lg p-4 rounded-4">
          <h3 class="text-center mb-3 fw-bold">Reset Password</h3>

          <p class="text-muted text-center mb-4" style="font-size: 0.95rem;">
            Lupa password? Masukkan email kamu dan kami akan kirimkan link untuk mengatur ulang password.
          </p>

          <!-- Session Status -->
          <x-auth-session-status class="mb-3" :status="session('status')" />

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <x-text-input id="email"
                            class="form-control rounded-pill"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
              <i class="bi bi-envelope-paper-heart me-1"></i>
              Kirim Link Reset Password
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
    transform: scale(1.05);
    background: linear-gradient(90deg, #4a90e2, #007bff);
  }
</style>
