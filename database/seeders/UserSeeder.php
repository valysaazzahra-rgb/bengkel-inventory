<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin123'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'staff@demo.com'],
            ['name' => 'Staff', 'password' => Hash::make('staff123'), 'role' => 'staff']
        );

        User::updateOrCreate(
            ['email' => 'owner@demo.com'],
            ['name' => 'Owner', 'password' => Hash::make('owner123'), 'role' => 'owner']
        );
    }
}