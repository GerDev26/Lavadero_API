<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Service;
use App\Models\TypeOfVehicle;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TypeOfVehicleSeeder::class);
        $this->call(RoleSeeder::class);
        User::factory(10)->create();
    }
}
