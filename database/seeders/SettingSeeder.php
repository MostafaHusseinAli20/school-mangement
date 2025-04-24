<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->truncate();
        
        $data = [
            ['key' => 'current_session', 'value' => '2024-2025', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'school_title', 'value' => 'MH', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'school_name', 'value' => 'ELSASA International Schools', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'end_first_term', 'value' => '31-12-2024', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'end_second_term', 'value' => '30-05-2025', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'phone', 'value' => '01234567891', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'address', 'value' => 'Cairo', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'school_email', 'value' => 'info@mh.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'logo', 'value' => '1.png', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('settings')->insert($data);
    }
}
