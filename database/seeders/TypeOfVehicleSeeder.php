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
                    'description' => 'auto',
                    'image' => 'https://www.karvi.com.ar/blog/wp-content/uploads/2020/10/208II3-850x567.jpg'
                ],
                [
                    'description' => 'moto',
                    'image' => 'https://resizer.iproimg.com/unsafe/1280x/filters:format(webp)/assets.iprofesional.com/assets/jpg/2024/05/573175.jpg'
                ],
                [
                    'description' => 'camioneta',
                    'image' => 'https://fotos.perfil.com//2021/06/25/900/0/hennessey-mammoth-1000-trx-asi-es-la-camioneta-mas-picante-y-potente-del-mundo-1195419.jpg'
                ],
            ];

            TypeOfVehicle::insert($data);
        }
    }
}
