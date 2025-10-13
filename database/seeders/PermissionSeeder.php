<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            ['name' => 'employee_management', 'guard_name' => 'web', 'is_active' => true],
            ['name' => 'visitor_management', 'guard_name' => 'web', 'is_active' => true],
            ['name' => 'dark_mode_toggle', 'guard_name' => 'web', 'is_active' => true], // Existing permission
        ];

        foreach ($permissions as $permissionData) {
            // Check if the permission exists before creating it
            if (!Permission::where('name', $permissionData['name'])->exists()) {
                Permission::create($permissionData);
            }
        }
    }
}
