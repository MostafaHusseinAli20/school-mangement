<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'ar' => 'المرحلة الابتدائية',
                'en' => 'Primary Grade'
            ],
            [
                'ar' => 'المرحلة الاعدادية',
                'en' => 'Prioty Grade'
            ],
            [
                'ar' => 'المرحلة الثانوية',
                'en' => 'Secondary Grade'
            ]
        ];

        foreach($grades as $grade)
        {
            Grade::create([
                'name' => $grade
            ]);
        }
    }
}
