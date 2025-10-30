<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorHostSchedule;
use App\Models\Visitor;
use App\Models\Employee;
use Illuminate\Support\Str;
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

        for ($i = 0; $i < 10; $i++) {
            $visitor = $visitors->random();
            // Randomly choose 1-3 employees, pick first if only one needed
            $employee = $employees->random();

            VisitorHostSchedule::create([
                'visitor_id' => $visitor->id,
                'employee_id' => $employee->id,
                'meeting_date' => Carbon::now()->addDays(rand(0, 30))->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
                'purpose' => Str::random(10) . ' purpose',
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
