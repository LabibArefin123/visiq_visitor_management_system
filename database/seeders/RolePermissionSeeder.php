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

        $blacklistVisitorPermissions = [
            'visitor_blacklists.index',   // View
            'visitor_blacklists.create',  // Create new
            'visitor_blacklists.store',   // Store new
            'visitor_blacklists.show',    // View individual
            'visitor_blacklists.edit',    // Edit
            'visitor_blacklists.update',  // Update
            'visitor_blacklists.destroy', // Delete
        ];

        $emergencyVisitorPermissions = [
            'visitor_emergencys.index',   // View
            'visitor_emergencys.create',  // Create new
            'visitor_emergencys.store',   // Store new
            'visitor_emergencys.show',    // View individual
            'visitor_emergencys.edit',    // Edit
            'visitor_emergencys.update',  // Update
            'visitor_emergencys.destroy', // Delete
        ];

        $pendingVisitorPermissions = [
            'pending_visitors.index',   // View
            'pending_visitors.create',  // Create new
            'pending_visitors.store',   // Store new
            'pending_visitors.show',    // View individual
            'pending_visitors.edit',    // Edit
            'pending_visitors.update',  // Update
            'pending_visitors.destroy', // Delete
        ];

        $systemUserPermission = [
            'system_users.index',   // View
            'system_users.create',  // Create new
            'system_users.store',   // Store new
            'system_users.show',    // View individual
            'system_users.edit',    // Edit
            'system_users.update',  // Update
            'system_users.destroy', // Delete
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

        foreach ($blacklistVisitorPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Blacklist Visitor'
            ]);
        }

        foreach ($emergencyVisitorPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Emergency Visitor'
            ]);
        }

        foreach ($pendingVisitorPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Pending Visitor'
            ]);
        }

        foreach ($systemUserPermission as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'System User'
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
