<?php

namespace App\Http\Controllers;

use App\Models\VisitorHostSchedule;
use App\Models\WeekendSchedule;
use App\Models\OfficeSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MeetingScheduleController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $selectedScheduleId = $request->input('office_schedule_id');

        // Active office schedules for dropdown
        $officeSchedules = OfficeSchedule::where('status', 'Active')->get();

        // Get weekend schedule (working days)
        $weekendSchedule = WeekendSchedule::where('status', 'Active')->first();
        $workingDays = $weekendSchedule ? explode(',', $weekendSchedule->working_days) : [];

        // Determine selected office schedule
        $selectedOffice = $selectedScheduleId
            ? $officeSchedules->firstWhere('id', $selectedScheduleId)
            : $officeSchedules->first();

        if (!$selectedOffice) {
            return view('schedule_management.meeting_schedule.index', [
                'days' => [],
                'month' => $month,
                'year' => $year,
                'officeSchedules' => $officeSchedules,
                'selectedScheduleId' => null,
                'selectedOffice' => null,
            ]);
        }

        // Fetch host schedules (meetings) **with relationships**
        $meetings = VisitorHostSchedule::with(['visitor', 'employee'])
            ->whereYear('meeting_date', $year)
            ->whereMonth('meeting_date', $month)
            ->get();

        $startOfMonth = Carbon::createFromDate($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $days = [];

        // Loop through days of the month
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $dayName = $date->format('l');

            // Skip non-working days
            if ($workingDays && !in_array($dayName, $workingDays)) {
                continue;
            }

            // Find meetings on this date
            $dayMeetings = $meetings->filter(function ($m) use ($date) {
                return $m->meeting_date->format('Y-m-d') === $date->format('Y-m-d');
            });

            // Add each meeting as a separate entry
            if ($dayMeetings->isNotEmpty()) {
                foreach ($dayMeetings as $meeting) {
                    $days[] = [
                        'schedule_name' => $selectedOffice->schedule_name,
                        'date' => $date->format('Y-m-d'),
                        'day_name' => $dayName,
                        'slot' => '--', // no hourly info yet
                        'title' => $meeting->purpose ?? 'N/A',
                        'meeting_type' => 'Single/Group', // placeholder
                        'status' => $meeting->status ?? 'No Meeting',
                        'description' => '--',
                        'visitor_name' => optional($meeting->visitor)->name ?? '--',
                        'employee_name' => optional($meeting->employee)->name ?? '--',
                    ];
                }
            } else {
                // No meeting for this day
                $days[] = [
                    'schedule_name' => $selectedOffice->schedule_name,
                    'date' => $date->format('Y-m-d'),
                    'day_name' => $dayName,
                    'slot' => '--',
                    'title' => 'No Meeting',
                    'meeting_type' => '--',
                    'status' => 'No Meeting',
                    'description' => '--',
                    'visitor_name' => '--',
                    'employee_name' => '--',
                ];
            }
        }

        return view('schedule_management.meeting_schedule.index', compact(
            'days',
            'month',
            'year',
            'officeSchedules',
            'selectedScheduleId',
            'selectedOffice'
        ));
    }
}
