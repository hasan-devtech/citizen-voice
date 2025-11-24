<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agency>
 */
class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => $this->faker->company(),
            'name_ar' => 'جهة ' . $this->faker->numberBetween(1, 500),
            'name_ku' => 'دەزگا ' . $this->faker->numberBetween(1, 500),
            'description_en' => $this->faker->sentence(),
            'description_ar' => 'وصف: ' . $this->faker->sentence(),
            'description_ku' => 'وەسف: ' . $this->faker->sentence(),
        ];
    }
}
