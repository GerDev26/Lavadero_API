<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $affectedRows = DB::table('services')->count();

        if ($affectedRows === 0) {
            $data = [
                [
                    'service_name' => 'lavado estandar',
                    'description' => 'Un lavado básico que incluye limpieza exterior e interior.',
                    'image' => 'https://img.freepik.com/foto-gratis/hermoso-coche-servicio-lavado_23-2149212221.jpg?size=626&ext=jpg&ga=GA1.1.672697106.1718928000&semt=ais_user'
                ],
                [
                    'service_name' => 'lavado premium',
                    'description' => 'Servicio de lavado completo con cera y detallado.',
                    'image' => 'https://media.istockphoto.com/id/1287044692/es/foto/trabajador-lavando-el-coche-rojo-con-esponja-en-un-lavado-de-coches.jpg?s=612x612&w=0&k=20&c=BL7c0IKAIOPf-4XEzdw1DELOSYu9rdzW95oaqggg6R8='
                ],
                [
                    'service_name' => 'motor',
                    'description' => 'Limpieza especializada del motor para un rendimiento óptimo.',
                    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgYyUdbkqLAn-FwCOszRUgVxTthd4uzVUCYw&s'
                ],
                [
                    'service_name' => 'tapizado',
                    'description' => 'Limpieza profunda de asientos y superficies tapizadas.',
                    'image' => 'https://media.ambito.com/p/c1600d7c6046275cf3841c46ac68ffa2/adjuntos/239/imagenes/041/310/0041310702/1200x675/smart/como-limpiar-el-tapizado-un-autowebp.png'
                ],
            ];

            Service::insert($data);
        }
    }
}
