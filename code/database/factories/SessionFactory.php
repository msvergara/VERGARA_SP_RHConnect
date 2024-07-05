<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'appointment_id' => 1,
            'session_px_bp' => $this->faker->randomNumber(3, true),
            'session_px_temperature' => $this->faker->randomNumber(2, true),
            'session_px_heartrate' => $this->faker->randomNumber(2, true),
            'session_px_respiratoryrate' => $this->faker->randomNumber(2, true),
            'session_px_oxygensat' => $this->faker->randomNumber(2, true),
            'session_px_height' => $this->faker->randomNumber(3, true),
            'session_px_weight' => $this->faker->randomNumber(3, true),
            'session_complaint' => $this->faker->sentence(),
            'session_findings' => $this->faker->sentence(),
            'session_treatment' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
