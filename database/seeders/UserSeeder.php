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
            'first_name' => 'Admin',
            'last_name'  => 'User',
            'name'       => 'admin',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('password'),
        ]);
    }
}
