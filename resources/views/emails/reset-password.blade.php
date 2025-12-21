@component('mail::message')
# Reset Password

Halo!  

Kami menerima permintaan untuk mengatur ulang password akun kamu.

Silakan klik tombol di bawah ini untuk melanjutkan proses reset password.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

**Link ini berlaku selama {{ $expire }} menit.**

Jika kamu tidak merasa melakukan permintaan ini, silakan abaikan email ini.

---

Salam hangat,  
**MI Muhammadiyah Mulyosari**
@endcomponent
