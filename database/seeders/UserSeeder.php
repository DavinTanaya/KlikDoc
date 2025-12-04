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
        // ADMIN
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@klikdoc.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // DOKTER
        User::create([
            'name' => 'Dr. Andi',
            'email' => 'andi@klikdoc.test',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);

        User::create([
            'name' => 'Dr. Maria',
            'email' => 'maria@klikdoc.test',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);

        User::create([
            'name' => 'Dr. Yusuf',
            'email' => 'yusuf@klikdoc.test',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);

        // USER / PASIEN
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "User {$i}",
                'email' => "user{$i}@klikdoc.test",
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}
