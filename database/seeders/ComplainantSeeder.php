<?php

namespace Database\Seeders;

use App\Models\Complainant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ComplainantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complainant::firstOrCreate([
            'identifier' => '0999999999',
            'full_name' => 'hasan',
            'birthdate' => '22-4-2000',
            'is_verified' => true,
            'password' => Hash::make('123456789'),
        ]);
        Complainant::factory()->count(20)->create();
    }
}
