<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sabillano057@gmail.com'],
            [
                'name' => 'Dorm Admin',
                'password' => Hash::make('sabillano2023'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'jarlsabillano@gmail.com'],
            [
                'name' => 'Dorm Staff',
                'password' => Hash::make('sabillano2023'),
                'role' => 'staff',
            ]
        );
    }
}
