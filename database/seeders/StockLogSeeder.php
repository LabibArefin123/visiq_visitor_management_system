<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockLog;
use App\Models\SupplyList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StockLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplies = SupplyList::all();

        $logTypes = ['in', 'out'];
        $users = ['Receptionist 1', 'Receptionist 2', 'Inventory Staff', 'Security Staff'];

        foreach ($supplies as $supply) {
            // Generate 3-5 logs per item
            $logsCount = rand(3, 5);
            for ($i = 0; $i < $logsCount; $i++) {
                // Random quantity: max 20% of supply quantity
                $maxQty = max(1, intval($supply->quantity * 0.2));
                $quantity = rand(1, $maxQty);

                StockLog::create([
                    'supply_list_id' => $supply->id,
                    'log_type' => $logTypes[array_rand($logTypes)],
                    'quantity' => $quantity,
                    'recorded_by' => $users[array_rand($users)],
                    'remarks' => 'Auto-generated log for testing',
                    'log_date' => Carbon::now()->addDays(rand(1, 60)), // random date in last 2 months
                ]);
            }
        }
    }
}
