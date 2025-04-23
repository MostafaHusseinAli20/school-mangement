<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TypeBooldSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecialisationsTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClasseSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ParentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
