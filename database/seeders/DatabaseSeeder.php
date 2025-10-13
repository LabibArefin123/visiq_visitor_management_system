<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uncomment this if you want to create 10 fake users
        // \App\Models\User::factory(10)->create();

        // Call the UserSeeder properly
        $this->call(UserSeeder::class);
    }
}
