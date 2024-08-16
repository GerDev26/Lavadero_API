<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Role;
use App\Models\Service;
use App\Models\TypeOfVehicle;
use App\Models\User;
use App\Models\Vehicle;
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
        $this->call(ServiceSeeder::class);
        $this->call(AdminSeeder::class);
        User::factory(10)->create();
        Appointment::factory(40)->create();
        Vehicle::factory(10)->create();
    }
}
