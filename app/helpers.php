<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('fotoProfil')) {
    function fotoProfil($user, $role = 'user')
    {
        if (
            $user &&
            $user->foto &&
            Storage::disk('public')->exists("foto_{$role}/{$user->foto}")
        ) {
            return asset("storage/foto_{$role}/{$user->foto}");
        }

        return asset("storage/foto_{$role}/default-{$role}.jpg");
    }
}
