<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complainant>
 */
class ComplainantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $identifier = $this->faker->boolean(50)
            ? $this->faker->unique()->safeEmail()
            : $this->faker->unique()->numerify('09########');
        return [
            'full_name' => $this->faker->name(),
            'identifier' => $identifier,
            'password' => Hash::make('password123'),
            'birthdate' => $this->faker->date(),
            'is_verified' => $this->faker->boolean(70),
        ];
    }
}
