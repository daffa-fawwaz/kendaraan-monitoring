<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kendaraan',
            'email' => 'admin@company.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Atasan Level 1',
            'email' => 'approver1@company.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);

        User::create([
            'name' => 'Atasan Level 2',
            'email' => 'approver2@company.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);

    }
}
