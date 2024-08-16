<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
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
                        'role_id' => 3
                    ]);
            
                    Vehicle::create([
                        'domain' => 'VLL199',
                        'user_id' => $ger->id,
                        'type_id' => 2,
                        'state' => 1
                    ]);
        }
        
    }
}
