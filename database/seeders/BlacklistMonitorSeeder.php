<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlacklistedVisitor;
use App\Models\BlacklistMonitor;
use Carbon\Carbon;

class BlacklistMonitorSeeder extends Seeder
{
    public function run(): void
    {
        $visitors = BlacklistedVisitor::all();
        $startDate = Carbon::parse('2025-11-01');
        $endDate = Carbon::parse('2026-01-20');

        foreach ($visitors as $visitor) {
            $date = $startDate->copy();

            while ($date->lte($endDate)) {
                // Randomly decide if visitor appears (30% chance)
                if (rand(0, 100) < 10) {
                    $checkIn = Carbon::parse('09:00')->addMinutes(rand(0, 180)); // random 9 AM to 12 PM
                    $checkOut = Carbon::parse('17:00')->addMinutes(rand(0, 120)); // random 5 PM to 7 PM

                    BlacklistMonitor::create([
                        'blacklisted_visitor_id' => $visitor->id,
                        'monitor_date' => $date->format('Y-m-d'),
                        'checked_in_at' => $checkIn->format('H:i:s'),
                        'checked_out_at' => $checkOut->format('H:i:s'),
                    ]);
                }
                $date->addDay();
            }
        }
    }
}
