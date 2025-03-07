<?php

namespace Database\Seeders;

use App\Models\Specialisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialisations')->delete();
        $specialisations = [
            ['en' => 'Arabic', 'ar' => 'عربي'],
            ['en' => 'Sciences', 'ar' => 'علوم'],
            ['en' => 'Computer', 'ar' => 'حاسب الي'],
            ['en' => 'English', 'ar' => 'انجليزي'],
            ['en' => 'Math', 'ar' => 'رياضيات']
        ];
        foreach ($specialisations as $specialisation) {
            Specialisation::create([
                'name' => $specialisation
            ]);
        }
    }
}
