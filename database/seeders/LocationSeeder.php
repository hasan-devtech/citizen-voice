<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            ['name_ar' => 'دمشق', 'name_en' => 'Damascus', 'name_ku' => 'Dîmeşk'],
            ['name_ar' => 'حلب', 'name_en' => 'Aleppo', 'name_ku' => 'Halab'],
            ['name_ar' => 'حمص', 'name_en' => 'Homs', 'name_ku' => 'Ḥimṣ'],
            ['name_ar' => 'حماة', 'name_en' => 'Hama', 'name_ku' => 'Ḥamah'],
            ['name_ar' => 'اللاذقية', 'name_en' => 'Latakia', 'name_ku' => 'Laṭaqiyya'],
            ['name_ar' => 'طرطوس', 'name_en' => 'Tartus', 'name_ku' => 'Ṭarṭūs'],
            ['name_ar' => 'الرقة', 'name_en' => 'Raqqa', 'name_ku' => 'Al‑Raqqa'],
            ['name_ar' => 'دير الزور', 'name_en' => 'Deir ez‑Zor', 'name_ku' => 'Dayr ez‑Zawr'],
            ['name_ar' => 'الحسكة', 'name_en' => 'Al-Hasakah', 'name_ku' => 'Hasakah'],
            ['name_ar' => 'درعا', 'name_en' => 'Daraa', 'name_ku' => 'Dera'],
            ['name_ar' => 'السويداء', 'name_en' => 'As-Suwayda', 'name_ku' => 'As‑Suweida'],
            ['name_ar' => 'إدلب', 'name_en' => 'Idlib', 'name_ku' => 'Idlib'],
            ['name_ar' => 'القنيطرة', 'name_en' => 'Quneitra', 'name_ku' => 'Quneitra'],
        ]);
    }
}
