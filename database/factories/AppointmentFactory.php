<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;

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
        // Generar una fecha excluyendo los domingos
        $date = $this->faker->dateTimeBetween('now', '+7 days');
        while ($date->format('w') == 0) {  // 0 representa el domingo
            $date = $this->faker->dateTimeBetween('now', '+7 days');
        }

        // Generar una hora entre las 8:00 y las 16:00 sin repetir en la misma fecha
        $hour = null;
        do {
            $hour = $this->faker->dateTimeBetween($date->format('Y-m-d') . ' 08:00:00', $date->format('Y-m-d') . ' 16:00:00')->format('H:i:s');
        } while (Appointment::where('date', $date->format('Y-m-d'))->where('hour', $hour)->exists());

        return [
            'hour' => $hour,
            'date' => $date->format('Y-m-d'),
            'state' => 'Disponible',
        ];
    }
}
