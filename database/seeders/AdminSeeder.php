<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Rumah Makan',
            'email' => 'admin@rumahmakan.com',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);
    }
}