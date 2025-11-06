<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorHostSchedule;
use App\Models\Visitor;
use App\Models\Employee;
use Carbon\Carbon;

class VisitorHostScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $visitors = Visitor::all();
        $employees = Employee::all();
        $statuses = ['scheduled', 'completed', 'cancelled'];

        if ($visitors->count() == 0 || $employees->count() == 0) {
            $this->command->info("No visitors or employees found. Seeder skipped.");
            return;
        }

        // Date range: 1 Nov 2025 - 15 Feb 2026
        $startDate = Carbon::create(2025, 11, 1);
        $endDate = Carbon::create(2026, 2, 15);

        // Common Bangladeshi office visit purposes
        $purposes = [
            'Official meeting regarding project update',
            'Submission of tender documents',
            'IT system maintenance discussion',
            'Vendor meeting for hardware supply',
            'Software troubleshooting visit',
            'Contract renewal discussion',
            'Salary or HR document verification',
            'Technical support consultation',
            'Visitor orientation and ID verification',
            'Meeting regarding upcoming audit',
            'Equipment delivery confirmation',
            'Follow-up on maintenance request',
            'Network inspection and testing',
            'Client proposal discussion',
            'Security compliance verification',
            'Office renovation site visit',
            'Internet connectivity issue resolution',
            'Attendance system setup discussion',
            'Employee grievance meeting',
            'Administrative file handover',
        ];

        for ($i = 0; $i < 100; $i++) {
            $visitor = $visitors->random();
            $employee = $employees->random();

            // Random date between range
            $randomDate = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));

            // Random time within working hours (8 AM – 8 PM)
            $hour = rand(8, 20);
            $minuteOptions = [0, 10, 15, 20, 30, 40, 45, 50];
            $minute = $minuteOptions[array_rand($minuteOptions)];
            $meetingDateTime = $randomDate->setTime($hour, $minute);

            VisitorHostSchedule::create([
                'visitor_id' => $visitor->id,
                'employee_id' => $employee->id,
                'meeting_date' => $meetingDateTime,
                'purpose' => $purposes[array_rand($purposes)],
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
