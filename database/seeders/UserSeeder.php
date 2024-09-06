<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Secret'),
        ]);

        User::create([
            'name' => 'Daemon',
            'email' => 'daemon@example.com',
            'password' => Hash::make('NotSecret'),
        ]);
    }
}
