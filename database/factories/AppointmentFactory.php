<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hour' => $this->faker->time(),
            'date' => $this->faker->dateTimeBetween('now', '+7 days')->format('Y-m-d'),
            'state' => 'Disponible'
        ];
    }
}
