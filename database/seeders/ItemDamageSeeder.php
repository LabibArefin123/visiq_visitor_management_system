<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemDamage;
use App\Models\SupplyList;
use Carbon\Carbon;

class ItemDamageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplies = SupplyList::all();

        if ($supplies->isEmpty()) {
            $this->command->info('No supplies found. Please run SupplyListSeeder first.');
            return;
        }

        for ($i = 1; $i <= 30; $i++) {
            $supply = $supplies->random();

            // Generate a random date between 1 Nov 2025 and 10 Feb 2026
            $start = Carbon::create(2025, 11, 1, 0, 0, 0, 'Asia/Dhaka');
            $end = Carbon::create(2026, 2, 10, 23, 59, 59, 'Asia/Dhaka');
            $randomDate = Carbon::createFromTimestamp(rand($start->timestamp, $end->timestamp));

            ItemDamage::create([
                'item_name' => $supply->item_name,
                'item_name_in_bangla' => $supply->item_name, // Or translate if you want
                'quantity' => rand(1, 20),
                'reported_by' => 'Staff ' . rand(1, 10),
                'damage_date' => $randomDate,
                'remarks' => 'Damaged during handling or usage',
            ]);
        }
    }
}
