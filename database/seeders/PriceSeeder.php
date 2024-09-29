<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
        $affectedRows = DB::table('prices')->count();

        if ($affectedRows === 0) {
            $data = [
                [
                    'value' => '10000',
                    'type_of_vehicle_id' => '1',
                    'service_id' => '1',
                    'created_at' => now(),
                ],
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '1',
                    'service_id' => '2',
                    'created_at' => now(),
                ],
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '1',
                    'service_id' => '3',
                    'created_at' => now(),
                ],
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '1',
                    'service_id' => '4',
                    'created_at' => now(),
                ],
                [
                    'value' => '8000',
                    'type_of_vehicle_id' => '2',
                    'service_id' => '1',
                    'created_at' => now(),
                ],
                [
                    'value' => '12000',
                    'type_of_vehicle_id' => '2',
                    'service_id' => '2',
                    'created_at' => now(),
                ],
                [
                    'value' => '5000',
                    'type_of_vehicle_id' => '2',
                    'service_id' => '3',
                    'created_at' => now(),
                ],
                [
                    'value' => '8000',
                    'type_of_vehicle_id' => '2',
                    'service_id' => '4',
                    'created_at' => now(),
                ],
                [
                    'value' => '20000',
                    'type_of_vehicle_id' => '3',
                    'service_id' => '1',
                    'created_at' => now(),
                ],
                [
                    'value' => '25000',
                    'type_of_vehicle_id' => '3',
                    'service_id' => '2',
                    'created_at' => now(),
                ],
                [
                    'value' => '12000',
                    'type_of_vehicle_id' => '3',
                    'service_id' => '3',
                    'created_at' => now(),
                ],
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '3',
                    'service_id' => '4',
                    'created_at' => now(),
                ],
            ];

            Price::insert($data);
    }
}
}