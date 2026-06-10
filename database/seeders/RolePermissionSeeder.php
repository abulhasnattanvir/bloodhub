<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ==================== PERMISSIONS ====================

        // Dashboard
        Permission::create(['name' => 'dashboard.view']);

        // Slider
        Permission::create(['name' => 'slider.view']);
        Permission::create(['name' => 'slider.create']);
        Permission::create(['name' => 'slider.edit']);
        Permission::create(['name' => 'slider.delete']);

        // Settings
        Permission::create(['name' => 'settings.view']);
        Permission::create(['name' => 'settings.edit']);

        // Pages
        Permission::create(['name' => 'page.view']);
        Permission::create(['name' => 'page.create']);
        Permission::create(['name' => 'page.edit']);
        Permission::create(['name' => 'page.delete']);

        // Footer Settings
        Permission::create(['name' => 'footer.edit']);

        // Members
        Permission::create(['name' => 'member.view']);
        Permission::create(['name' => 'member.edit']);
        Permission::create(['name' => 'member.approve']);
        Permission::create(['name' => 'member.delete']);

        // Council
        Permission::create(['name' => 'council.view']);
        Permission::create(['name' => 'council.create']);
        Permission::create(['name' => 'council.edit']);
        Permission::create(['name' => 'council.delete']);

        // Donations (Manual Payment)
        Permission::create(['name' => 'donation.view']);
        Permission::create(['name' => 'donation.approve']);
        Permission::create(['name' => 'donation.reject']);
        Permission::create(['name' => 'donation.delete']);

        // Menus
        Permission::create(['name' => 'menu.view']);
        Permission::create(['name' => 'menu.create']);
        Permission::create(['name' => 'menu.edit']);
        Permission::create(['name' => 'menu.delete']);
        Permission::create(['name' => 'menu.sort']);

        // Goals
        Permission::create(['name' => 'goal.view']);
        Permission::create(['name' => 'goal.create']);
        Permission::create(['name' => 'goal.edit']);
        Permission::create(['name' => 'goal.delete']);

        // Activities
        Permission::create(['name' => 'activity.view']);
        Permission::create(['name' => 'activity.create']);
        Permission::create(['name' => 'activity.edit']);
        Permission::create(['name' => 'activity.delete']);

        // FAQ
        Permission::create(['name' => 'faq.view']);
        Permission::create(['name' => 'faq.create']);
        Permission::create(['name' => 'faq.edit']);
        Permission::create(['name' => 'faq.delete']);

        // Contact Settings
        Permission::create(['name' => 'contact.edit']);

        // Messages
        Permission::create(['name' => 'message.view']);
        Permission::create(['name' => 'message.show']);
        Permission::create(['name' => 'message.mark-read']);
        Permission::create(['name' => 'message.delete']);

        // Finance
        Permission::create(['name' => 'finance.view']);
        Permission::create(['name' => 'finance.mark-paid']);

        // Fees
        Permission::create(['name' => 'fee.view']);
        Permission::create(['name' => 'fee.create']);
        Permission::create(['name' => 'fee.edit']);
        Permission::create(['name' => 'fee.delete']);

        // Gallery
        Permission::create(['name' => 'gallery.view']);
        Permission::create(['name' => 'gallery.create']);
        Permission::create(['name' => 'gallery.edit']);
        Permission::create(['name' => 'gallery.delete']);

        // Green Initiative
        Permission::create(['name' => 'green.view']);
        Permission::create(['name' => 'green.create']);
        Permission::create(['name' => 'green.edit']);
        Permission::create(['name' => 'green.delete']);

        // Videos
        Permission::create(['name' => 'video.view']);
        Permission::create(['name' => 'video.create']);
        Permission::create(['name' => 'video.edit']);
        Permission::create(['name' => 'video.delete']);

        // Blog
        Permission::create(['name' => 'blog.view']);
        Permission::create(['name' => 'blog.create']);
        Permission::create(['name' => 'blog.edit']);
        Permission::create(['name' => 'blog.delete']);

        // Blog Category
        Permission::create(['name' => 'blog-category.view']);
        Permission::create(['name' => 'blog-category.create']);
        Permission::create(['name' => 'blog-category.edit']);
        Permission::create(['name' => 'blog-category.delete']);

        // Blog Tag
        Permission::create(['name' => 'blog-tag.view']);
        Permission::create(['name' => 'blog-tag.create']);
        Permission::create(['name' => 'blog-tag.edit']);
        Permission::create(['name' => 'blog-tag.delete']);

        // Role & Permission Management
        Permission::create(['name' => 'role.view']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.delete']);
        Permission::create(['name' => 'role.permission-sync']);

        // ==================== ROLES ====================

        $admin = Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $editor = Role::create(['name' => 'Editor']);

        // Admin gets everything
        $admin->givePermissionTo(Permission::all());

        // Manager
        $manager->givePermissionTo([
            'dashboard.view',
            'slider.view',
            'slider.create',
            'slider.edit',
            'member.view',
            'member.edit',
            'member.approve',
            'donation.view',
            'donation.approve',
            'donation.reject',
            'finance.view',
            'finance.mark-paid',
            'gallery.view',
            'gallery.create',
            'gallery.edit',
            'blog.view',
            'blog.create',
            'blog.edit',
            'message.view',
            'message.show',
            'message.mark-read',
        ]);

        // Editor
        $editor->givePermissionTo([
            'dashboard.view',
            'slider.view',
            'gallery.view',
            'blog.view',
            'blog.create',
            'blog.edit',
            'page.view',
            'faq.view',
            'activity.view',
            'goal.view',
        ]);

        $this->command->info('Roles and Permissions seeded successfully!');
    }
}