<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super-admin', 'status' => 1],
            ['name' => 'Admin', 'slug' => 'admin', 'status' => 1],
            ['name' => 'Customer', 'slug' => 'customer', 'status' => 1],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
