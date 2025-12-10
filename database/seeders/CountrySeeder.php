<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::create(['name' => 'India', 'code' => 'IN', 'status' => 1]);
    }
}
