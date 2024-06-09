<?php

namespace Database\Factories;

use App\Models\Patients;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientsFactory extends Factory
{
    /* Add the table model */
    protected $model = Patients::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $barangay = $this->faker->randomElement([
            "Poblacion I",
            "Poblacion II",
            "Poblacion III",
            "Poblacion IV",
            "Betania",
            "Canantong",
            "Nauzon",
            "Pinagbayanan",
            "Sagana",
            "San Antonio",
            "San Felipe",
            "San Fernando",
            "San Isidro",
            "San Josep",
            "San Juan",
            "San Vicente",
            "Siclong",
        ]);

        return [
            //
            'patient_fname' => $this->faker->firstName($gender),
            'patient_mname' => $this->faker->lastName(),
            'patient_lname' => $this->faker->lastName(),
            'patient_extension' => $this->faker->suffix(),
            'patient_sex' => $gender,
            'patient_birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'patient_barangay' => $barangay,
            'patient_street' => $this->faker->streetName(),
            // 'patient_hsenum' => $this->faker->numerify('hse-#####'),
            'patient_cpnum' => $this->faker->mobileNumber(),
            'hcworker_id' => $this->faker->numberBetween(1, 7),
            'created_at' => $this->faker->dateTimeThisDecade()
        ];
    }
}
