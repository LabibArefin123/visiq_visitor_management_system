<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterviewSchedule;
use App\Models\VisitorJobApplication;
use App\Models\Employee;
use Carbon\Carbon;

class InterviewScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch candidates and employees
        $candidates = VisitorJobApplication::all();
        $employees = Employee::pluck('id')->toArray();

        if ($candidates->isEmpty() || empty($employees)) {
            $this->command->warn('⚠️ Please seed VisitorJobApplication and Employee tables first.');
            return;
        }

        $statuses = ['pending', 'completed', 'cancelled'];
        $remarks = [
            'Candidate performed well',
            'Needs further evaluation',
            'Excellent communication skills',
            'Average performance',
            'Interview rescheduled due to technical issues',
            'Candidate did not attend',
            'Position already filled',
        ];

        foreach ($candidates as $candidate) {
            InterviewSchedule::create([
                'candidate_id' => $candidate->id,
                'employee_id' => $employees[array_rand($employees)],
                'interview_date' => Carbon::create(2025, 11, 15)->addDays(rand(0, 98)), // 15 Nov 2025 to 20 Feb 2026
                'position' => $candidate->position,
                'status' => $statuses[array_rand($statuses)],
                'remarks' => $remarks[array_rand($remarks)],
            ]);
        }

        $this->command->info('✅ InterviewScheduleSeeder successfully seeded!');
    }
}
