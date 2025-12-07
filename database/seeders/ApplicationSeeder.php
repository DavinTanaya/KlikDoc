<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Application::create([
            'user_id' => 5,
            'full_name' => 'Dr. Ahmad Fauzi',
            'nik' => '1234567890123456',
            'gender' => 'male',
            'str' => 'STR-123456',
            'sip' => 'SIP-654321',
            'spesialisasi' => 'Dokter Umum',
            'document' => 'documents/ahmad_fauzi_cert.pdf',
            'status' => 'approved',
            'is_active' => true,
            'experience_years' => 5,
        ]);
    }
}
