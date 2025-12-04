<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users   = User::where('role', 'user')->get();
        $doctors = User::where('role', 'doctor')->get();

        foreach ($users as $user) {
            Chat::create([
                'user_id'   => $user->id,
                'doctor_id' => $doctors->random()->id,
            ]);
        }
    }
}
