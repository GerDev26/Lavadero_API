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
                    'description' => 'lavado estandar',
                ],
                [
                    'description' => 'lavado premium',
                ],
                [
                    'description' => 'motor',
                ],
                [
                    'description' => 'tapizado',
                ],
            ];

            Service::insert($data);
        }
    }
}
