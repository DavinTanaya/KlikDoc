<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyTexts = [
            "Halo dok, saya mau konsultasi.",
            "Baik, apa keluhannya?",
            "Saya demam sejak kemarin.",
            "Apakah sudah minum obat?",
            "Belum dok.",
            "Baik, saya sarankan periksa suhu tubuhnya ya.",
        ];

        foreach (Chat::all() as $chat) {
            $total = rand(4, 6);

            for ($i = 0; $i < $total; $i++) {
                Message::create([
                    'chat_id'   => $chat->id,
                    'sender_id' => ($i % 2 === 0) ? $chat->user_id : $chat->doctor_id,
                    'body'      => $dummyTexts[array_rand($dummyTexts)],
                ]);
            }
        }
    }
}
