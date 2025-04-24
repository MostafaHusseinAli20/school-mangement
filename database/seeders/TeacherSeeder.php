<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'email' => 'teacher@example.com',
            'password' => Hash::make('123456789'),
            'name' => ['ar' => 'حسام', 'en' => 'Hossam'],
            'joining_data' => Carbon::createFromFormat('d-m-Y', '12-01-2025')->toDateString(),
            'address' => 'Elmatria',
            'specialist_id' => 2,
            'gender_id' => 1
        ]);
    }
}
