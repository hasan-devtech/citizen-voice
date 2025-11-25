<?php

namespace Database\Seeders;

use App\Models\ComplaintCategory;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('complaint_categories')->insert([
            [
                'name_ar' => 'الكهرباء',
                'name_en' => 'Electricity',
                'name_ku' => 'کارەبا',
                'description_ar' => 'مشاكل الكهرباء والانقطاع والعدادات',
                'description_en' => 'Electricity-related issues',
                'description_ku' => 'کێشەکانی کارەبا و شەشەکان',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'المياه',
                'name_en' => 'Water',
                'name_ku' => 'ئاو',
                'description_ar' => 'مشاكل المياه والشبكات',
                'description_en' => 'Water-related issues',
                'description_ku' => 'کێشەکانی ئاو و شەبەکەکان',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'النظافة',
                'name_en' => 'Sanitation',
                'name_ku' => 'پاکیزەکاری',
                'description_ar' => 'شكاوى النظافة والقمامة',
                'description_en' => 'Sanitation and waste complaints',
                'description_ku' => 'شکایەتی پاکیزەکاری و خەرابکاری',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        ComplaintCategory::factory()->count(10)->create();
    }
}
