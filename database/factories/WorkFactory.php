<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // get pic
        $pics = [
            'Listrik',
            'Production',
            'Bengkel',
        ];

        // get classification
        $classifications = [
            'Temuan PPM',
            'Kondisi Alat',
        ];

        // get pant, registration, and classification
        $pic = $this->faker->randomElement($pics);
        $plant = 'Phonska III';
        $registration = sprintf(
            '%s%05d',
            strtoupper(substr($pic, 0, 1)),
            $this->faker->unique()->numberBetween(1, 99999)
        );
        $classification = $this->faker->randomElement($classifications);

        // return array
        return [
            'date' => $this->faker->dateTimeBetween('-10 days', '+10 days'),
            'pic' => $pic,
            'plant' => $plant,
            'registration' => $registration,
            'classification' => $classification,
            'parameter' => $this->faker->word(),
            'equipment' => $this->faker->regexify('[A-Z0-9]{8}'),
            'frequency' => $this->faker->randomElement(['Rutin', 'Tahunan']),
        ];
    }
}
