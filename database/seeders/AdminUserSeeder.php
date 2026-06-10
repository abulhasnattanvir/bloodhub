<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        if (!User::where('email', 'admin@example.com')->exists()) {
            $admin = User::create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]);

            $admin->assignRole('Admin');
        }

        // MANAGER
        if (!User::where('email', 'manager@example.com')->exists()) {
            $manager = User::create([
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => Hash::make('manager123'),
                'is_admin' => false,
            ]);

            $manager->assignRole('Manager');
        }

        // EDITOR
        if (!User::where('email', 'editor@example.com')->exists()) {
            $editor = User::create([
                'name' => 'Editor User',
                'email' => 'editor@example.com',
                'password' => Hash::make('editor123'),
                'is_admin' => false,
            ]);

            $editor->assignRole('Editor');
        }
    }
}