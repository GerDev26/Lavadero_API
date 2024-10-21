<?php
namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
        $affectedRows = DB::table('prices')->count();

        if ($affectedRows === 0) {
            $data = [
                // Precios para diferentes tipos de vehículos (1: auto, 2: moto, 3: camioneta)
                
                // Lavado estándar
                [
                    'value' => '10000',
                    'type_of_vehicle_id' => '1', // auto
                    'service_id' => '1',
                    'created_at' => now(),
                ],
                [
                    'value' => '8000',
                    'type_of_vehicle_id' => '2', // moto
                    'service_id' => '1',
                    'created_at' => now(),
                ],
                [
                    'value' => '20000',
                    'type_of_vehicle_id' => '3', // camioneta
                    'service_id' => '1',
                    'created_at' => now(),
                ],

                // Lavado premium
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '1', // auto
                    'service_id' => '2',
                    'created_at' => now(),
                ],
                [
                    'value' => '12000',
                    'type_of_vehicle_id' => '2', // moto
                    'service_id' => '2',
                    'created_at' => now(),
                ],
                [
                    'value' => '25000',
                    'type_of_vehicle_id' => '3', // camioneta
                    'service_id' => '2',
                    'created_at' => now(),
                ],

                // Motor
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '1', // auto
                    'service_id' => '3',
                    'created_at' => now(),
                ],
                [
                    'value' => '5000',
                    'type_of_vehicle_id' => '2', // moto
                    'service_id' => '3',
                    'created_at' => now(),
                ],
                [
                    'value' => '12000',
                    'type_of_vehicle_id' => '3', // camioneta
                    'service_id' => '3',
                    'created_at' => now(),
                ],

                // Tapizado
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '1', // auto
                    'service_id' => '4',
                    'created_at' => now(),
                ],
                [
                    'value' => '8000',
                    'type_of_vehicle_id' => '2', // moto
                    'service_id' => '4',
                    'created_at' => now(),
                ],
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '3', // camioneta
                    'service_id' => '4',
                    'created_at' => now(),
                ],

                // Lavado estándar y motor
                [
                    'value' => '18000',
                    'type_of_vehicle_id' => '1', // auto
                    'service_id' => '5',
                    'created_at' => now(),
                ],
                [
                    'value' => '13000',
                    'type_of_vehicle_id' => '2', // moto
                    'service_id' => '5',
                    'created_at' => now(),
                ],
                [
                    'value' => '30000',
                    'type_of_vehicle_id' => '3', // camioneta
                    'service_id' => '5',
                    'created_at' => now(),
                ],

                // Lavado estándar y tapizado
                [
                    'value' => '18000',
                    'type_of_vehicle_id' => '1', // auto
                    'service_id' => '6',
                    'created_at' => now(),
                ],
                [
                    'value' => '15000',
                    'type_of_vehicle_id' => '2', // moto
                    'service_id' => '6',
                    'created_at' => now(),
                ],
                [
                    'value' => '28000',
                    'type_of_vehicle_id' => '3', // camioneta
                    'service_id' => '6',
                    'created_at' => now(),
                ],

                // Motor y tapizado
                [
                    'value' => '25000',
                    'type_of_vehicle_id' => '1', // auto
                    'service_id' => '7',
                    'created_at' => now(),
                ],
                [
                    'value' => '18000',
                    'type_of_vehicle_id' => '2', // moto
                    'service_id' => '7',
                    'created_at' => now(),
                ],
                [
                    'value' => '35000',
                    'type_of_vehicle_id' => '3', // camioneta
                    'service_id' => '7',
                    'created_at' => now(),
                ],
            ];

            Price::insert($data);
        }
    }
}
