<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Checkout;

class CheckoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Checkout::create([
            'name' => 'John Doe',
            'phone' => '1234567890',
            'reason' => 'Business Meeting',
        ]);

        Checkout::create([
            'name' => 'Jane Smith',
            'phone' => '9876543210',
            'reason' => 'Personal Visit',
        ]);
    }
}
