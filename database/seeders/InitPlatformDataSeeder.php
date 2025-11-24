<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitPlatformDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AgencySeeder::class,
            ComplaintCategorySeeder::class,
            ComplainantSeeder::class,
            LocationSeeder::class,
            ComplaintSeeder::class
        ]);
    }
}
