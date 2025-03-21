<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'name_section' => ['ar' => 'أ', 'en' => 'A'],
            'status' => 1,
            'grade_id' => 1,
            'classe_id' => 1
        ]);
    }
}
