<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LostAndFound;
use App\Models\Visitor;
use Carbon\Carbon;

class LostAndFoundSeeder extends Seeder
{
    public function run(): void
    {
        $visitors = Visitor::inRandomOrder()->take(6)->get();

        if ($visitors->isEmpty()) {
            $this->command->warn('⚠️ No visitors found. Please seed the visitors table first.');
            return;
        }

        $statuses = ['Lost', 'Found', 'Returned'];
        $items = [
            'Wallet',
            'Mobile Phone',
            'Office ID Card',
            'Umbrella',
            'Wristwatch',
            'Bag',
            'Laptop Charger',
            'Notebook',
            'Car Key',
            'Water Bottle',
            'Pen Drive'
        ];
        $locations = [
            'Main Lobby',
            'Reception Area',
            'Cafeteria',
            'Parking Zone',
            'Meeting Room',
            'Gym Area',
            'Building Entrance',
            'Security Gate'
        ];
        $descriptions = [
            'Item reported by visitor after leaving the office.',
            'Security found this item during evening patrol.',
            'Returned to the rightful owner after verification.',
            'Found near the reception desk, currently with admin.',
            'Item misplaced during meeting, later recovered.',
            'Staff noticed the item in the visitor lounge.',
        ];

        // Create records between 10 Nov 2025 – 1 Feb 2026
        $startDate = Carbon::parse('2025-11-10');
        $endDate = Carbon::parse('2026-02-01');

        foreach ($visitors as $visitor) {
            for ($i = 0; $i < rand(2, 4); $i++) {
                LostAndFound::create([
                    'item_name'     => $items[array_rand($items)],
                    'visitor_id'    => $visitor->id,
                    'status'        => $statuses[array_rand($statuses)],
                    'location'      => $locations[array_rand($locations)],
                    'reported_date' => Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp)),
                    'description'   => $descriptions[array_rand($descriptions)],
                ]);
            }
        }
    }
}
