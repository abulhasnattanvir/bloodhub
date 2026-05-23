<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BloodGroup;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodGroups = [
            ['name' => 'A+', 'description' => 'A positive blood group'],
            ['name' => 'A-', 'description' => 'A negative blood group'],
            ['name' => 'B+', 'description' => 'B positive blood group'],
            ['name' => 'B-', 'description' => 'B negative blood group'],
            ['name' => 'AB+', 'description' => 'AB positive blood group'],
            ['name' => 'AB-', 'description' => 'AB negative blood group'],
            ['name' => 'O+', 'description' => 'O positive blood group'],
            ['name' => 'O-', 'description' => 'O negative blood group'],
        ];

        foreach ($bloodGroups as $group) {
            BloodGroup::firstOrCreate($group);
        }
    }
}