<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = json_decode(file_get_contents(database_path('seeders/provinces.json')), true);

        foreach ($provinces as $province) {
            Province::create([
                'name'        => $province['name'],
                'province_id' => $province['id'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}