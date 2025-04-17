<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define standard actions
        $actions = ['view', 'create', 'update', 'delete', 'restore', 'force delete'];

        // Define models
        $models = ['short term goals', 'long term goals', 'users',];

        // Generate permissions dynamically
        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::create(['name' => "{$action} {$model}"]);
           }
       }

       // Create Roles
       $adminRole = Role::create(['name' => 'admin']);

       // Assign permissions to roles
       $adminRole->givePermissionTo(Permission::all()); // Admin gets all permissions

        // Create an admin user
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'user_slug' => Str::slug('Admin'),
        ]);

        $adminUser->assignRole($adminRole);
    }
}
