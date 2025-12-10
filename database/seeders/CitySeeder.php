<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        // Gujarat
        City::create(['state_id' => 1, 'name' => 'Ahmedabad', 'code' => 'AMD', 'status' => 1]);
        City::create(['state_id' => 1, 'name' => 'Surat', 'code' => 'SRT', 'status' => 1]);

        // Maharashtra
        City::create(['state_id' => 2, 'name' => 'Mumbai', 'code' => 'MUM', 'status' => 1]);
        City::create(['state_id' => 2, 'name' => 'Pune', 'code' => 'PUN', 'status' => 1]);
    }
}
