<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $affectedRows = DB::table('roles')->count();

        if ($affectedRows === 0) {
            $data = [
                [
                    'description' => 'administrador'
                ],
                [
                    'description' => 'empleado'
                ],
                [
                    'description' => 'cliente'
                ],
            ];

            Role::insert($data);
        }
    }
}
