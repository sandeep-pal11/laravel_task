<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        State::create(['country_id' => 1, 'name' => 'Gujarat', 'code' => 'GJ', 'status' => 1]);
        State::create(['country_id' => 1, 'name' => 'Maharashtra', 'code' => 'MH', 'status' => 1]);
    }
}
