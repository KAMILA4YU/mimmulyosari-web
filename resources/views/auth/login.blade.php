<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<x-guest-layout>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg p-4 rounded-4">
          <h3 class="text-center mb-4 fw-bold">Login Akun</h3>

          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <x-text-input id="email" class="form-control rounded-pill"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <x-text-input id="password" class="form-control rounded-start-pill"
                              type="password" name="password" required autocomplete="current-password" />
                <span class="input-group-text rounded-end-pill" onclick="togglePassword('password', this)" style="cursor:pointer;">
                  <i class="bi bi-eye"></i>
                </span>
              </div>
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
              <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
              <label for="remember_me" class="form-check-label">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
              <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </button>

            <div class="d-flex justify-content-between mt-3">
              @if (Route::has('password.request'))
                <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                  Lupa Password?
                </a>
              @endif

              <a href="{{ route('register') }}" class="text-decoration-none small">
                Belum punya akun?
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT TOGGLE PASSWORD -->
  <script>
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      const icon = el.querySelector('i');

      if (input.type === "password") {
          input.type = "text";
          icon.classList.remove("bi-eye");
          icon.classList.add("bi-eye-slash");
      } else {
          input.type = "password";
          icon.classList.remove("bi-eye-slash");
          icon.classList.add("bi-eye");
      }
    }
  </script>
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
