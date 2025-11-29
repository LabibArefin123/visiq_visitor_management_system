<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorGroupSchedule;
use App\Models\VisitorGroupMember;
use App\Models\Employee;
use App\Models\VisitorHostSchedule;
use Carbon\Carbon;

class VisitorGroupScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Define date range (Bangladesh working days: Sunday–Thursday)
        $startDate = Carbon::create(2025, 11, 10);
        $endDate = Carbon::create(2026, 2, 28);

        // Fetch existing meeting dates from VisitorHostSchedule (to avoid duplicates)
        $usedDates = VisitorHostSchedule::pluck('meeting_date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->toArray();

        $visitorGroups = VisitorGroupMember::pluck('id')->unique()->toArray();
        $employees = Employee::pluck('id')->toArray();

        if (empty($visitorGroups) || empty($employees)) {
            $this->command->warn('⚠️ Please seed VisitorGroupMember and Employee tables first!');
            return;
        }

        $meetingPurposes = [
            'Project Discussion',
            'Technical Collaboration',
            'Contract Review',
            'Security Briefing',
            'Tender Evaluation',
            'Training Session',
            'Inspection Meeting',
            'Vendor Introduction',
            'After-Sales Support Discussion',
            'Budget Planning'
        ];

        $locations = [
            'Dhaka HQ - Meeting Room A',
            'Chittagong Regional Office',
            'Khulna Branch Conference Hall',
            'Rajshahi Division Office',
            'Sylhet Field Unit',
            'Gazipur Plant Meeting Hall',
            'Narayanganj Sales Center',
        ];

        $statuses = ['scheduled', 'completed', 'cancelled'];

        $meetingCount = 0;

        // Iterate through each date in the range
        for ($date = $startDate->copy(); $date->lte($endDate) && $meetingCount < 75; $date->addDay()) {

            // Skip Fridays and Saturdays (Bangladesh weekend)
            if (in_array($date->dayOfWeek, [5, 6])) {
                continue;
            }

            // Skip if date already used by visitor host schedules
            if (in_array($date->format('Y-m-d'), $usedDates)) {
                continue;
            }

            // Randomly decide if meeting happens on this date (rarely)
            if (rand(1, 100) > 35) { // only 35% chance of meeting
                continue;
            }

            // Random number of meetings on same day (1 to 2)
            $meetingsToday = rand(1, 2);

            for ($i = 0; $i < $meetingsToday && $meetingCount < 75; $i++) {
                VisitorGroupSchedule::create([
                    'visitor_group_id' => $visitorGroups[array_rand($visitorGroups)],
                    'employee_id' => $employees[array_rand($employees)],
                    'meeting_date' => $date->copy()->setTime(rand(9, 16), [0, 15, 30, 45][array_rand([0, 1, 2, 3])]),
                    'meeting_location' => $locations[array_rand($locations)],
                    'purpose' => $meetingPurposes[array_rand($meetingPurposes)],
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $meetingCount++;
            }
        }

        $this->command->info("✅ $meetingCount Visitor Group Schedule records created successfully!");
    }
}
