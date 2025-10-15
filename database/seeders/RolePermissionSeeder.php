<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $defaultPermissions = [
            'home',
        ];

        $userPermissions = [
            'users.index',   // View
            'users.create',  // Create new
            'users.store',   // Store new
            'users.show',    // View individual
            'users.edit',    // Edit
            'users.update',  // Update
            'users.destroy', // Delete
        ];

        $rolePermissions = [
            'roles.index',   // View
            'roles.create',  // Create new
            'roles.store',   // Store new
            'roles.show',    // View individual
            'roles.edit',    // Edit
            'roles.update',  // Update
            'roles.destroy', // Delete
        ];

        $permissionPermissions = [
            'permissions.index',   // View
            'permissions.create',  // Create new
            'permissions.store',   // Store new
            'permissions.show',    // View individual
            'permissions.edit',    // Edit
            'permissions.update',  // Update
            'permissions.destroy', // Delete
        ];

        $visitorPermissions = [
            'visitors.index',   // View
            'visitors.create',  // Create new
            'visitors.store',   // Store new
            'visitors.show',    // View individual
            'visitors.edit',    // Edit
            'visitors.update',  // Update
            'visitors.destroy', // Delete
        ];

        foreach ($defaultPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Default'
            ]);
        }

        foreach ($userPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'User'
            ]);
        }

        foreach ($rolePermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Role'
            ]);
        }

        foreach ($permissionPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Permission'
            ]);
        }

        foreach ($visitorPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Visitor'
            ]);
        }
        // End Permissions

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // Assign Permissions to Roles
        $adminRole->syncPermissions(Permission::all());
        $editorRole->syncPermissions([
            'users.index',
            'users.create',
            'users.store',
            'users.edit',
            'users.update',
        ]);

        // Assign role to a user (for testing)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
