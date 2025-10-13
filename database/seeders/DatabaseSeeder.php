<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Permission::create(['name' => 'ai chat access']);
        Permission::create(['name' => 'ai chat interact']);
        Permission::create(['name' => 'ai chat store']);
        Permission::create(['name' => 'ai chat list']);
        Permission::create(['name' => 'ai chat view']);
        Permission::create(['name' => 'ai chat export']);
        Permission::create(['name' => 'ai chat download']);

        // Assign permissions to roles
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo(Permission::all());

        $user = Role::create(['name' => 'User']);
        $user->givePermissionTo(['ai chat interact', 'ai chat store']);
    }
}
