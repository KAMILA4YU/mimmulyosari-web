<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin
        User::updateOrCreate(
            ['email' => 'admin.testing@gmail.com'], // nanti bisa diganti ke mimulyosari@gmail.com
            [
                'name' => 'Admin MIM Mulyosari',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Akun user biasa
        User::updateOrCreate(
            ['email' => 'user.testing@gmail.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('user12345'),
                'role' => 'user',
            ]
        );
    }
}
