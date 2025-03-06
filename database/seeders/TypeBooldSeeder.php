<?php

namespace Database\Seeders;

use App\Models\TypeBlood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeBooldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_bloods')->delete();
        $bgs = ['O-', 'O+','A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach($bgs as $bg)
        {
            TypeBlood::create([
                'name' => $bg
            ]);
        }
    }
}
