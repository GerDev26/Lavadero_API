<?php

namespace Database\Factories;

use App\Models\TypeOfVehicle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amoutUsers = User::count();
        $amoutTypes = TypeOfVehicle::count();
        $randomUser = $this->faker->numberBetween(1, $amoutUsers);
        $randomType = $this->faker->numberBetween(1, $amoutTypes);
        $domain = Str::random(6);
        return [
            'state' => 1,
            'domain' => $domain,
            'user_id' => $randomUser,
            'type_id' => $randomType
        ];
    }
}
