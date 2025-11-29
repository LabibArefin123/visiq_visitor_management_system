<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guard;
use App\Models\GuardActivityLog;
use Carbon\Carbon;

class GuardActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $guards = Guard::all();
        $startDate = Carbon::parse('2025-11-01');
        $endDate = Carbon::parse('2026-02-01');

        foreach ($guards as $guard) {
            $date = $startDate->copy();

            while ($date->lte($endDate)) {
                // Randomly decide if guard comes this day (60% chance)
                if (rand(0, 100) < 60) {
                    $shiftStart = Carbon::parse('08:00')->addMinutes(rand(0, 60)); // random 8:00-9:00 AM
                    $shiftEnd = Carbon::parse('16:00')->addMinutes(rand(0, 60));   // random 4:00-5:00 PM

                    GuardActivityLog::create([
                        'guard_id' => $guard->id,
                        'log_date' => $date->format('Y-m-d'),
                        'check_in' => $shiftStart->format('H:i:s'),
                        'check_out' => $shiftEnd->format('H:i:s'),
                    ]);
                }
                $date->addDay();
            }
        }
    }
}
