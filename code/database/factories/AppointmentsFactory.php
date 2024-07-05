<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AppointmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $date_from = $this->faker->dateTimeThisMonth('+5 days');
        $date_from = $this->faker->dateTimeThisYear();
        static $counter = 1;

        return [
            //
            'title' => "Sample Appointment " . $counter,
            'description' => "This is a sample description for Sample Appointment " . $counter++,
            'appointment_datetime'=> $date_from,
            'patient_id' => 1,
            'session_status' => 0,
            // 'date_to'=> $this->faker->dateTimeBetween($date_from, ($date_from->format('Y-m-d H:i:s') . '+5 days')),
        ];
    }
}
