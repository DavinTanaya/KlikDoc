<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KlikHomeService;
use Illuminate\Support\Str;

class KlikHomeServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Immune Booster Infusion',
                'slug' => 'immune-booster-infusion',
                'category' => 'Vitamin Booster',
                'description' => 'Infus vitamin C dan B Complex dosis optimal untuk meningkatkan daya tahan tubuh dan mempercepat pemulihan.',
                'duration_minutes' => 45,
                'price' => 350000,
                'service_fee' => 5000,
                'handled_by' => 'Perawat Terverifikasi',
                'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#ef6c00"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
                'benefits' => [
                    'Meningkatkan daya tahan tubuh',
                    'Membantu pemulihan flu',
                    'Antioksidan',
                    'Mengurangi kelelahan'
                ],
                'inclusions' => [
                    'Infus Vitamin C + B Complex',
                    'Jasa perawat home care',
                    'Alat medis steril',
                    'Cek tanda vital'
                ],
                'safety_notes' => [
                    [
                        'title' => 'APD Lengkap',
                        'desc'  => 'Perawat menggunakan masker, sarung tangan, dan APD sesuai standar.'
                    ],
                    [
                        'title' => 'Alat Sekali Pakai',
                        'desc'  => 'Jarum dan selang infus baru dibuka di depan pasien.'
                    ],
                ],
                'time_slots' => [
                    '09:00 - 10:00',
                    '10:00 - 11:00',
                    '13:00 - 14:00',
                    '15:00 - 16:00',
                ],
                'is_active' => true,
            ],

            [
                'name' => 'Medical Checkup Basic',
                'slug' => 'medical-checkup-basic',
                'category' => 'Lab Tes',
                'description' => 'Pemeriksaan darah lengkap, kolesterol, gula darah, dan asam urat.',
                'duration_minutes' => 15,
                'price' => 450000,
                'service_fee' => 5000,
                'handled_by' => 'Analis Laboratorium',
                'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#7b1fa2"><path d="M4.8 2.3V10a6 6 0 0 0 12 0V4"/></svg>',
                'benefits' => [
                    'Deteksi dini penyakit',
                    'Monitoring kesehatan rutin'
                ],
                'inclusions' => [
                    'Pengambilan sampel darah',
                    'Hasil lab resmi',
                    'Kunjungan home care'
                ],
                'safety_notes' => null,
                'time_slots' => [
                    '08:00 - 09:00',
                    '09:00 - 10:00',
                ],
                'is_active' => true,
            ],

            // ================= VAKSIN =================
            [
                'name' => 'Vaksin Influenza 4 Strain',
                'slug' => 'vaksin-influenza-4-strain',
                'category' => 'Vaksinasi',
                'description' => 'Perlindungan terhadap flu musiman untuk dewasa dan lansia.',
                'duration_minutes' => 10,
                'price' => 380000,
                'service_fee' => 5000,
                'handled_by' => 'Dokter Umum',
                'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#2e7d32"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                'benefits' => [
                    'Mencegah flu berat',
                    'Imunitas lebih stabil'
                ],
                'inclusions' => [
                    'Vaksin influenza resmi',
                    'Jasa dokter',
                    'Alat steril'
                ],
                'safety_notes' => null,
                'time_slots' => [
                    '09:00 - 10:00',
                    '13:00 - 14:00',
                ],
                'is_active' => true,
            ],

            // ================= DOKTER =================
            [
                'name' => 'Kunjungan Dokter Umum',
                'slug' => 'kunjungan-dokter-umum',
                'category' => 'Dokter / Bidan',
                'description' => 'Pemeriksaan fisik dan konsultasi langsung di rumah Anda.',
                'duration_minutes' => 60,
                'price' => 250000,
                'service_fee' => 5000,
                'handled_by' => 'Dokter Umum',
                'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#00838f"><rect x="6" y="2" width="12" height="20"/></svg>',
                'benefits' => null,
                'inclusions' => [
                    'Pemeriksaan fisik',
                    'Diagnosa',
                    'Resep obat (jika perlu)'
                ],
                'safety_notes' => null,
                'time_slots' => [
                    '10:00 - 11:00',
                    '14:00 - 15:00',
                ],
                'is_active' => true,
            ],

            // ================= GROOMING =================
            [
                'name' => 'Perawatan Luka (Wound Care)',
                'slug' => 'perawatan-luka',
                'category' => 'Grooming & Care',
                'description' => 'Perawatan luka pasca operasi atau luka diabetes.',
                'duration_minutes' => 45,
                'price' => 200000,
                'service_fee' => 5000,
                'handled_by' => 'Perawat Luka',
                'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#ad1457"><path d="M20 12L5 20V4z"/></svg>',
                'benefits' => null,
                'inclusions' => [
                    'Pembersihan luka',
                    'Balutan steril',
                    'Monitoring kondisi'
                ],
                'safety_notes' => null,
                'time_slots' => [
                    '09:00 - 10:00',
                    '11:00 - 12:00',
                ],
                'is_active' => true,
            ],

            // ================= BIDAN =================
            [
                'name' => 'Home Care Pasca Melahirkan',
                'slug' => 'home-care-pasca-melahirkan',
                'category' => 'Dokter / Bidan',
                'description' => 'Kunjungan bidan untuk ibu dan bayi pasca persalinan.',
                'duration_minutes' => 60,
                'price' => 300000,
                'service_fee' => 5000,
                'handled_by' => 'Bidan',
                'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#1565c0"><circle cx="12" cy="12" r="10"/></svg>',
                'benefits' => [
                    'Monitoring kesehatan ibu',
                    'Perawatan bayi'
                ],
                'inclusions' => [
                    'Kunjungan bidan',
                    'Edukasi ibu dan bayi'
                ],
                'safety_notes' => null,
                'time_slots' => [
                    '13:00 - 14:00',
                    '15:00 - 16:00',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            KlikHomeService::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
