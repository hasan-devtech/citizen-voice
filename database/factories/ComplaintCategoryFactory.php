<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComplaintCategory>
 */
class ComplaintCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => $this->faker->word(),
            'name_ar' => 'نوع شكوى ' . $this->faker->numberBetween(1, 500),
            'name_ku' => 'جۆری شکایەت ' . $this->faker->numberBetween(1, 500),
            'description_en' => $this->faker->sentence(),
            'description_ar' => 'وصف: ' . $this->faker->sentence(),
            'description_ku' => 'وەسف: ' . $this->faker->sentence(),
        ];
    }
}
