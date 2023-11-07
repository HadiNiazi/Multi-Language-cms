<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@cdlcell.com',
            'email_verified_at' => now(),
            'role' => 1,
            'password' => Hash::make(12345678),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@cdlcell.com',
            'email_verified_at' => now(),
            'role' => 0,
            'password' => Hash::make(12345678),
        ]);

    }
}
