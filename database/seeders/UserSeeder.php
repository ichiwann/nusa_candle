<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin Users
        User::create([
            'nama_lengkap' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'alamat' => 'Malang',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'total_poin' => null,
        ]);

        // Create Pembeli Users
        User::create([
            'nama_lengkap' => 'Ichwan Akbar',
            'username' => 'iwan',
            'email' => 'iwan@gmail.com',
            'alamat' => 'kemantren',
            'password' => Hash::make('12345'),
            'role' => 'pembeli',
            'total_poin' => 150,
        ]);
    }
}
