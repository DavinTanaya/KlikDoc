<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drug;

class DrugSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Antibiotik',
            'Analgesik',
            'Antipiretik',
            'Antiseptik',
            'Antihistamin',
            'Vitamin & Suplemen',
            'Obat Batuk & Flu',
            'Obat Maag',
            'Anti Inflamasi'
        ];

        $types = [
            'Tablet',
            'Kapsul',
            'Sirup',
            'Salep',
            'Injeksi'
        ];

        for ($i = 1; $i <= 20; $i++) {

            $name = fake()->randomElement([
                'Paracetamol 500mg',
                'Ibuprofen 400mg',
                'Amoxicillin 500mg',
                'Cetirizine 10mg',
                'Omeprazole 20mg',
                'Vitamin C 1000mg',
                'Antangin Sirup',
                'Promag',
                'Mixagrip Flu',
                'Bodrex Migraine',
                'Panadol Extra',
                'Konidin Sirup',
                'Sanmol Tablet',
                'Albendazole 400mg',
                'Antibiotik Meropenem'
            ]);

            Drug::create([
                'name' => $name,
                'category' => fake()->randomElement($categories),
                'image' => null, // default tidak pakai gambar
                'description' => fake()->paragraph(),
                'short_description' => fake()->sentence(),
                'dosis' => fake()->numberBetween(1, 3) . "× sehari",
                'price' => fake()->numberBetween(5000, 150000),
                'stock' => fake()->numberBetween(0, 500),
                'type' => fake()->randomElement($types),
                'is_active' => true
            ]);
        }
    }
}
