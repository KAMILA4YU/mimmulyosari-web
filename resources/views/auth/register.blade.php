<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<x-guest-layout>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg p-4 rounded-4">
          <h3 class="text-center mb-4 fw-bold">Registrasi Akun</h3>

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lengkap</label>
              <x-text-input id="name" class="form-control rounded-pill" type="text"
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <x-text-input id="email" class="form-control rounded-pill" type="email"
                            name="email" :value="old('email')" required autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <x-text-input id="password" class="form-control rounded-start-pill"
                              type="password" name="password" required autocomplete="new-password" />
                <span class="input-group-text rounded-end-pill" onclick="togglePassword('password', this)" style="cursor:pointer;">
                  <i class="bi bi-eye"></i>
                </span>
              </div>
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
              <div class="input-group">
                <x-text-input id="password_confirmation" class="form-control rounded-start-pill"
                              type="password" name="password_confirmation" required autocomplete="new-password" />
                <span class="input-group-text rounded-end-pill" onclick="togglePassword('password_confirmation', this)" style="cursor:pointer;">
                  <i class="bi bi-eye"></i>
                </span>
              </div>
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
              <i class="bi bi-person-plus me-1"></i> Daftar
            </button>

            <p class="text-center mt-3 mb-0">
              Sudah punya akun?
              <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
            </p>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT SHOW/HIDE PASSWORD -->
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
