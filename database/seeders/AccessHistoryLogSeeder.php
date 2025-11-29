<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssignPointGuard;
use App\Models\AccessHistoryLog;
use Carbon\Carbon;

class AccessHistoryLogSeeder extends Seeder
{
    public function run(): void
    {
        $assignments = AssignPointGuard::all();
        $startDate = Carbon::parse('2025-11-01');
        $endDate = Carbon::parse('2026-02-01');

        foreach ($assignments as $assignment) {
            $date = $startDate->copy();

            while ($date->lte($endDate)) {
                // Randomly decide if guard came (50% chance)
                if (rand(0, 100) < 80) {
                    $accessTime = Carbon::parse($assignment->shift_start ?? '09:00')->addMinutes(rand(0, 60));
                    $leftTime = Carbon::parse($assignment->shift_end ?? '17:00')->addMinutes(rand(0, 60));

                    AccessHistoryLog::create([
                        'assign_point_guard_id' => $assignment->id,
                        'log_date' => $date->format('Y-m-d'),
                        'accessed_at' => $accessTime->format('H:i:s'),
                        'left_at' => $leftTime->format('H:i:s'),
                    ]);
                }
                $date->addDay();
            }
        }
    }
}
