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
        // You can also use factories if needed
        // \App\Models\User::factory(10)->create();

        // ✅ Properly call multiple seeders in sequence
        $this->call([
            UserSeeder::class,
            VisitorSeeder::class,
        ]);
    }
}
