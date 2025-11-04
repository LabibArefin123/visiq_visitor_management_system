<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemRequest;
use App\Models\SupplyList;
use Carbon\Carbon;

class ItemRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplies = SupplyList::all(); // Get all supplies

        $departments = ['HR', 'IT', 'Accounts', 'Reception', 'Security', 'Management'];
        $requestTypes = ['Replacement', 'New Supply', 'Urgent Request', 'Maintenance'];
        $statuses = ['pending', 'approved', 'rejected'];
        $names = ['Rahim', 'Karim', 'Ayesha', 'Fatema', 'Jahid', 'Labib', 'Nabila', 'Rafi'];

        // Create 50 random requests
        for ($i = 0; $i < 50; $i++) {
            $supply = $supplies->random();

            ItemRequest::create([
                'supply_list_id' => $supply->id,
                'requester_name' => $names[array_rand($names)],
                'department' => $departments[array_rand($departments)],
                'request_type' => $requestTypes[array_rand($requestTypes)],
                'quantity' => rand(1, 20),
                'status' => $statuses[array_rand($statuses)],
                'remarks' => 'Auto-generated request for testing',
            ]);
        }
    }
}
