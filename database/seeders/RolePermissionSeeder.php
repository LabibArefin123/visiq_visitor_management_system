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

        $employeePermissions = [
            'employees.index',   // View
            'employees.create',  // Create new
            'employees.store',   // Store new
            'employees.show',    // View individual
            'employees.edit',    // Edit
            'employees.update',  // Update
            'employees.destroy', // Delete
            'employee_attendances.index',
            'employees.check_in_employee.index', // Delete
            'employees.check_out_employee.index', // Delete
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

        $visitorCompanyPermissions = [
            'visitor_companies.index',   // View
            'visitor_companies.create',  // Create new
            'visitor_companies.store',   // Store new
            'visitor_companies.show',    // View individual
            'visitor_companies.edit',    // Edit
            'visitor_companies.update',  // Update
            'visitor_companies.destroy', // Delete
        ];

        $organizationPermissions = [
            'organizations.index',   // View
            'organizations.create',  // Create new
            'organizations.store',   // Store new
            'organizations.show',    // View individual
            'organizations.edit',    // Edit
            'organizations.update',  // Update
            'organizations.destroy', // Delete
        ];

        $blacklistVisitorPermissions = [
            'visitor_blacklists.index',   // View
            'visitor_blacklists.create',  // Create new
            'visitor_blacklists.store',   // Store new
            'visitor_blacklists.show',    // View individual
            'visitor_blacklists.edit',    // Edit
            'visitor_blacklists.update',  // Update
            'visitor_blacklists.destroy', // Delete
            'visitor_blacklists.activity_log', // Activity Log
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

        $visitorGroupMemberPermissions = [
            'visitor_group_members.index',   // View
            'visitor_group_members.create',  // Create new
            'visitor_group_members.store',   // Store new
            'visitor_group_members.show',    // View individual
            'visitor_group_members.edit',    // Edit
            'visitor_group_members.update',  // Update
            'visitor_group_members.destroy', // Delete
        ];

        $visitorHostSchedulePermissions = [
            'visitor_host_schedules.index',   // View
            'visitor_host_schedules.create',  // Create new
            'visitor_host_schedules.store',   // Store new
            'visitor_host_schedules.show',    // View individual
            'visitor_host_schedules.edit',    // Edit
            'visitor_host_schedules.update',  // Update
            'visitor_host_schedules.destroy', // Delete
        ];

        $shiftSchedulePermissions = [
            'shift_schedules.index',   // View
            'shift_schedules.create',  // Create new
            'shift_schedules.store',   // Store new
            'shift_schedules.show',    // View individual
            'shift_schedules.edit',    // Edit
            'shift_schedules.update',  // Update
            'shift_schedules.destroy', // Delete
        ];

        $officeSchedulePermissions = [
            'office_schedules.index',   // View
            'office_schedules.create',  // Create new
            'office_schedules.store',   // Store new
            'office_schedules.show',    // View individual
            'office_schedules.edit',    // Edit
            'office_schedules.update',  // Update
            'office_schedules.destroy', // Delete
        ];

        $shiftGuardSchedulePermissions = [
            'shift_guard_schedules.index',   // View
            'shift_guard_schedules.create',  // Create new
            'shift_guard_schedules.store',   // Store new
            'shift_guard_schedules.show',    // View individual
            'shift_guard_schedules.edit',    // Edit
            'shift_guard_schedules.update',  // Update
            'shift_guard_schedules.destroy', // Delete
        ];

        $accessPointPermissions = [
            'access_points.index',   // View
            'access_points.create',  // Create new
            'access_points.store',   // Store new
            'access_points.show',    // View individual
            'access_points.edit',    // Edit
            'access_points.update',  // Update
            'access_points.destroy', // Delete
        ];

        $guardPermissions = [
            'guards.index',   // View
            'guards.create',  // Create new
            'guards.store',   // Store new
            'guards.show',    // View individual
            'guards.edit',    // Edit
            'guards.update',  // Update
            'guards.destroy', // Delete
            'guards.activity_log', // Activity log
        ];

        $accessPointGuardPermissions = [
            'access_point_guards.index',   // View
            'access_point_guards.create',  // Create new
            'access_point_guards.store',   // Store new
            'access_point_guards.show',    // View individual
            'access_point_guards.edit',    // Edit
            'access_point_guards.update',  // Update
            'access_point_guards.destroy', // Delete
            'access_point_guards.activity_log', // Delete
        ];

        $emergencyIncidentPermissions = [
            'emergency_incidents.index',   // View
            'emergency_incidents.create',  // Create new
            'emergency_incidents.store',   // Store new
            'emergency_incidents.show',    // View individual
            'emergency_incidents.edit',    // Edit
            'emergency_incidents.update',  // Update
            'emergency_incidents.destroy', // Delete
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

        foreach ($employeePermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Employee'
            ]);
        }

        foreach ($visitorPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Visitor'
            ]);
        }

        foreach ($visitorCompanyPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Visitor Company'
            ]);
        }

        foreach ($organizationPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Organization'
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

        foreach ($visitorGroupMemberPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Visitor Group Member'
            ]);
        }

        foreach ($visitorHostSchedulePermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Visitor Host Schedule'
            ]);
        }

        foreach ($shiftSchedulePermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Shift Schedule'
            ]);
        }

        foreach ($officeSchedulePermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Office Schedule'
            ]);
        }

        foreach ($shiftGuardSchedulePermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Guard Shift Schedule'
            ]);
        }

        // security menu
        foreach ($accessPointPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Access Point'
            ]);
        }

        foreach ($guardPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Guard'
            ]);
        }

        foreach ($accessPointGuardPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Access Point Guard'
            ]);
        }

        foreach ($emergencyIncidentPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Emergency Incident'
            ]);
        }
        // setting menu
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
