<?php

namespace Database\Seeders;

use App\Models\Agency;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('agencies')->insert([
            [
                'name_ar' => 'وزارة الكهرباء',
                'name_en' => 'Ministry of Electricity',
                'name_ku' => 'وەزارەتی کارەبا',
                'description_ar' => 'الجهة المسؤولة عن الكهرباء',
                'description_en' => 'Responsible authority for electricity',
                'description_ku' => 'دەزگا بەرپرسی کارەبا',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'وزارة المياه',
                'name_en' => 'Ministry of Water',
                'name_ku' => 'وەزارەتی ئاو',
                'description_ar' => 'الجهة المسؤولة عن المياه',
                'description_en' => 'Responsible authority for water',
                'description_ku' => 'دەزگا بەرپرسی ئاو',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'بلدية دمشق',
                'name_en' => 'Damascus Municipality',
                'name_ku' => 'ڕاپەڕاندنی شاری داماسق',
                'description_ar' => 'الجهة المسؤولة عن خدمات المدينة',
                'description_en' => 'City public services authority',
                'description_ku' => 'دەزگا بەرپرسی خزمەتگوزاری شار',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        Agency::factory()->count(10)->create();
    }
}
