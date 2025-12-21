<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmail
{
    /**
     * Generate verification URL
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(
                Config::get('auth.verification.expire', 60)
            ),
            [
                'id'   => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email Akun MI Muhammadiyah Mulyosari')
            ->greeting('Assalamu’alaikum Warahmatullahi Wabarakatuh')
            ->line('Terima kasih telah melakukan pendaftaran akun pada Sistem Informasi MI Muhammadiyah Mulyosari.')
            ->line('Untuk mengaktifkan akun Anda, silakan lakukan verifikasi alamat email dengan menekan tombol di bawah ini:')
            ->action('Verifikasi Email', $verificationUrl)
            ->line('Tautan verifikasi ini bersifat pribadi dan hanya berlaku selama 60 menit sejak email ini dikirim.')
            ->line('Apabila Anda tidak merasa melakukan pendaftaran akun, silakan abaikan email ini.')
            ->salutation(
                "Hormat kami,\n\n" .
                "MI Muhammadiyah Mulyosari\n" .
                "Sistem Informasi Sekolah"
            );
    }
}
