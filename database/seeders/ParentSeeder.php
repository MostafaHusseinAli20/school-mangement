<?php

namespace Database\Seeders;

use App\Models\MyParent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MyParent::create([
            'email' => 'parent@example.com',
            'password' => Hash::make('123456789'),
            'name_father' => ['ar' => 'فوزي', 'en' => 'Fawzy'],
            'national_ID_father' => '01234567890',
            'passport_ID_father' => '01234567890',
            'phone_father' => '01234567890',
            'job_father' => ['ar' => 'مهندس', 'en' => 'Enginner'],
            'address_father' => 'NewYourk',
            'name_mother' => ['ar' => 'ليلي', 'en' => 'Laila'],
            'national_ID_mother' => '01234567890',
            'passport_ID_mother' => '01234567890',
            'phone_mother' => '01234567890',
            'job_mother' => ['ar' => 'مهندسة', 'en' => 'Enginner'],
            'address_mother' => 'NewYourk',
            'nationality_father_id' => 22,
            'blood_type_father_id' => 1,
            'religion_father_id' => 1,
            'nationality_mother_id' => 22,
            'blood_type_mother_id' => 1,
            'religion_mother_id' => 1
        ]);
    }
}
