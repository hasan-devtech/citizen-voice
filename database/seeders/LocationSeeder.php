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
            [
                'name_ar' => 'دمشق',
                'name_en' => 'Damascus',
                'name_ku' => 'Dîmeşk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'حلب',
                'name_en' => 'Aleppo',
                'name_ku' => 'Halab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'حمص',
                'name_en' => 'Homs',
                'name_ku' => 'Ḥimṣ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'حماة',
                'name_en' => 'Hama',
                'name_ku' => 'Ḥamah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'اللاذقية',
                'name_en' => 'Latakia',
                'name_ku' => 'Laṭaqiyya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'طرطوس',
                'name_en' => 'Tartus',
                'name_ku' => 'Ṭarṭūs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'الرقة',
                'name_en' => 'Raqqa',
                'name_ku' => 'Al‑Raqqa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'دير الزور',
                'name_en' => 'Deir ez‑Zor',
                'name_ku' => 'Dayr ez‑Zawr',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'الحسكة',
                'name_en' => 'Al-Hasakah',
                'name_ku' => 'Hasakah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'درعا',
                'name_en' => 'Daraa',
                'name_ku' => 'Dera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'السويداء',
                'name_en' => 'As-Suwayda',
                'name_ku' => 'As‑Suweida',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'إدلب',
                'name_en' => 'Idlib',
                'name_ku' => 'Idlib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'القنيطرة',
                'name_en' => 'Quneitra',
                'name_ku' => 'Quneitra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
