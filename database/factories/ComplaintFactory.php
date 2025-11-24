<?php

namespace Database\Factories;

use App\Enums\ComplaintStatusEnum;
use App\Models\Agency;
use App\Models\Complainant;
use App\Models\ComplaintCategory;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'complainant_id' => Complainant::inRandomOrder()->first()?->id ?? Complainant::factory(),
            'complaint_category_id' => ComplaintCategory::inRandomOrder()->first()?->id ?? ComplaintCategory::factory(),
            'location_id' => Location::inRandomOrder()->first()?->id ?? Location::factory(),
            'agency_id' => Agency::inRandomOrder()->first()?->id ?? Agency::factory(),
            'reference_number' => strtoupper($this->faker->bothify('CMP-#####')),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(ComplaintStatusEnum::cases()), 
        ];
    }
}
