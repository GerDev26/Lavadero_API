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
                    'duration' => 30
                ],
                [
                    'description' => 'lavado premium',
                    'duration' => 60
                ],
                [
                    'description' => 'motor',
                    'duration' => 30
                ],
                [
                    'description' => 'tapizado',
                    'duration' => 30
                ],
            ];

            Service::insert($data);
        }
    }
}
