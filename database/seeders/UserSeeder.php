<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'germancanteros26@gmail.com')->get();

        if($user->isEmpty()) {
                    $ger = User::create([
                        'name' => 'German',
                        'surname' => 'Canteros',
                        'email' => 'germancanteros26@gmail.com',
                        'password' => '26111999grc',
                        'phone_number' => '1123871463',
                        'role_id' => 1
                    ]);
                    $romi = User::create([
                        'name' => 'Romina',
                        'surname' => 'Duarte',
                        'email' => 'rominaduarte@gmail.com',
                        'password' => '26111999grc',
                        'phone_number' => '1123871463',
                        'role_id' => 2
                    ]);
                    $fede = User::create([
                        'name' => 'Federico',
                        'surname' => 'Duarte',
                        'email' => 'fededuarte@gmail.com',
                        'password' => '26111999grc',
                        'phone_number' => '1123871463',
                        'role_id' => 3
                    ]);
            
                    Vehicle::create([
                        'domain' => 'AVLL199',
                        'user_id' => $ger->id,
                        'type_id' => 2,
                        'state' => 1
                    ]);
                    Vehicle::create([
                        'domain' => 'AVLL192',
                        'user_id' => $romi->id,
                        'type_id' => 2,
                        'state' => 1
                    ]);
                    Vehicle::create([
                        'domain' => 'AVLL139',
                        'user_id' => $fede->id,
                        'type_id' => 2,
                        'state' => 1
                    ]);
        }
        
    }
}
