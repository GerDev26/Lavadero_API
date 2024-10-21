<?php
namespace Database\Seeders;

use App\Models\Service;
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
                // Servicios individuales
                [
                    'service_name' => 'lavado estandar',
                    'description' => 'Un lavado básico que incluye limpieza exterior e interior.',
                    'image' => 'https://img.freepik.com/foto-gratis/hermoso-coche-servicio-lavado_23-2149212221.jpg?size=626&ext=jpg&ga=GA1.1.672697106.1718928000&semt=ais_user'
                ],
                [
                    'service_name' => 'lavado premium',
                    'description' => 'Servicio de lavado completo con cera y detallado. Incluye motor y tapizado',
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
                [
                    'service_name' => 'lavado estandar y motor',
                    'description' => 'Lavado estándar con limpieza especializada del motor.',
                    'image' => 'https://www.bardahlindustria.com/wp-content/uploads/2021/02/lavado-de-motor-rapido-y-facil.jpg' // Cambia por una imagen adecuada
                ],
                [
                    'service_name' => 'lavado estandar y tapizado',
                    'description' => 'Lavado estándar más limpieza profunda de asientos y superficies tapizadas.',
                    'image' => 'https://www.cleanipedia.com/images/iohqr4whhl17/3n4VcHrpVWQUHe3KiPY7eZ/6542d00b60b83f7c4cbe9ba9f8aa5c77/dGFwaXphZG9zLWRlLWF1dG8tY29tby1saW1waW8tbG9zLWFzaWVudG9zLWRlLW1pYXV0by5qcGc/1200w/tapizados-de-auto-como-limpio-los-asientos-de-miauto.jpg' // Cambia por una imagen adecuada
                ],
                [
                    'service_name' => 'motor y tapizado',
                    'description' => 'Limpieza especializada del motor y limpieza profunda de tapizados.',
                    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRa1s6ZyVHwUWcSkN9NGIjjVChMk2SKB4t9KQ&s' // Cambia por una imagen adecuada
                ],
            ];

            Service::insert($data);
        }
    }
}
