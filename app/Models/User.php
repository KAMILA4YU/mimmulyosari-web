<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    public function getFotoProfilAttribute()
    {
        // Admin
        if ($this->role === 'admin') {
            if ($this->foto && file_exists(public_path('storage/foto_admin/' . $this->foto))) {
                return 'storage/foto_admin/' . $this->foto;
            }

            return 'img/default-admin.jpg';
        }

        // User
        if ($this->foto && file_exists(public_path('foto_user/' . $this->foto))) {
            return 'foto_user/' . $this->foto;
        }

        return 'img/default-user.jpg';
    }

    /**
     * Relasi: User punya banyak Pengaduan
     */
    public function pengaduans() 
    {
        return $this->hasMany(Pengaduan::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


}
