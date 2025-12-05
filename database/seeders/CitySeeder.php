<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = json_decode(file_get_contents(database_path('seeders/regencies.json')), true);

        foreach ($cities as $city) {
            City::create([
                'city_id'     => $city['id'],
                'province_id' => $city['province_id'], 
                'name'        => $city['name'],
            ]);
        }
    }
}


