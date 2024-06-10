<?php

namespace Database\Seeders;

use App\Models\TypeOfVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $affectedRows = DB::table('type_of_vehicles')->count();

        if ($affectedRows === 0) {
            $data = [
                [
                    'description' => 'auto'
                ],
                [
                    'description' => 'moto'
                ],
                [
                    'description' => 'camioneta'
                ],
            ];

            TypeOfVehicle::insert($data);
        }
    }
}
