<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teacher_grades')->insert([
            'teacher_id' => 1,
            'grade_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
