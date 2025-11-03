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
            'dashboard',
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
            'visitors.feedback', // feedback
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

        // building menu
        $areaPermissions = [
            'areas.index',   // View
            'areas.create',  // Create new
            'areas.store',   // Store new
            'areas.show',    // View individual
            'areas.edit',    // Edit
            'areas.update',  // Update
            'areas.destroy', // Delete
        ];

        $subAreaPermissions = [
            'sub_areas.index',   // View
            'sub_areas.create',  // Create new
            'sub_areas.store',   // Store new
            'sub_areas.show',    // View individual
            'sub_areas.edit',    // Edit
            'sub_areas.update',  // Update
            'sub_areas.destroy', // Delete
        ];

        $buildingLocationPermissions = [
            'building_locations.index',   // View
            'building_locations.create',  // Create new
            'building_locations.store',   // Store new
            'building_locations.show',    // View individual
            'building_locations.edit',    // Edit
            'building_locations.update',  // Update
            'building_locations.destroy', // Delete
        ];

        $buildingListPermissions = [
            'building_lists.index',   // View
            'building_lists.create',  // Create new
            'building_lists.store',   // Store new
            'building_lists.show',    // View individual
            'building_lists.edit',    // Edit
            'building_lists.update',  // Update
            'building_lists.destroy', // Delete
        ];

        $roomListPermissions = [
            'room_lists.index',   // View
            'room_lists.create',  // Create new
            'room_lists.store',   // Store new
            'room_lists.show',    // View individual
            'room_lists.edit',    // Edit
            'room_lists.update',  // Update
            'room_lists.destroy', // Delete
        ];

        // organization menu
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

        //asset menu
        $parkingListPermissions = [
            'parking_lists.index',   // View
            'parking_lists.create',  // Create new
            'parking_lists.store',   // Store new
            'parking_lists.show',    // View individual
            'parking_lists.edit',    // Edit
            'parking_lists.update',  // Update
            'parking_lists.destroy', // Delete
        ];

        //asset menu
        $lostAndFoundPermissions = [
            'lost_and_founds.index',   // View
            'lost_and_founds.create',  // Create new
            'lost_and_founds.store',   // Store new
            'lost_and_founds.show',    // View individual
            'lost_and_founds.edit',    // Edit
            'lost_and_founds.update',  // Update
            'lost_and_founds.destroy', // Delete
        ];

        // security menu
        $anncouncementPermissions = [
            'announcements.index',   // View
            'announcements.create',  // Create new
            'announcements.store',   // Store new
            'announcements.show',    // View individual
            'announcements.edit',    // Edit
            'announcements.update',  // Update
            'announcements.destroy', // Delete
        ];

        $overstayAlertPermissions = [
            'overstay_alerts.index',   // View
            'overstay_alerts.create',  // Create new
            'overstay_alerts.store',   // Store new
            'overstay_alerts.show',    // View individual
            'overstay_alerts.edit',    // Edit
            'overstay_alerts.update',  // Update
            'overstay_alerts.destroy', // Delete
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

        $userCategoriesPermission = [
            'user_categories.index',   // View
            'user_categories.create',  // Create new
            'user_categories.store',   // Store new
            'user_categories.show',    // View individual
            'user_categories.edit',    // Edit
            'user_categories.update',  // Update
            'user_categories.destroy', // Delete
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

        foreach ($organizationPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Organization'
            ]);
        }

        foreach ($areaPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Area'
            ]);
        }

        foreach ($subAreaPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Sub Area'
            ]);
        }

        foreach ($buildingLocationPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Building Location'
            ]);
        }

        foreach ($buildingListPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Building List'
            ]);
        }

        foreach ($roomListPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Room List'
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

        foreach ($employeePermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Employee'
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

        foreach ($parkingListPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Parking List'
            ]);
        }

        foreach ($anncouncementPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Announcement'
            ]);
        }

        foreach ($lostAndFoundPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Lost And Found'
            ]);
        }

        foreach ($overstayAlertPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Overstay Alert'
            ]);
        }

        foreach ($emergencyIncidentPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'Emergency Incident'
            ]);
        }
        // setting menu
        foreach ($userCategoriesPermission as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'module' => 'User Categories'
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
