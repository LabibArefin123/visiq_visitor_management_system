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
        $selectedWeekendId = $request->input('weekend_schedule_id');

        // 🔹 Fetch all active weekend schedules
        $weekendSchedules = WeekendSchedule::where('status', 'Active')->get();

        // 🔹 Determine selected weekend schedule
        $selectedWeekend = $selectedWeekendId
            ? $weekendSchedules->firstWhere('id', $selectedWeekendId)
            : $weekendSchedules->first();

        // 🔹 Parse working days
        $workingDays = [];
        if ($selectedWeekend && !empty($selectedWeekend->working_days)) {
            $workingDays = array_map('trim', explode(',', $selectedWeekend->working_days));
        }

        // 🔹 Fetch all meetings for this month
        $meetings = VisitorHostSchedule::with(['visitor', 'employee'])
            ->whereYear('meeting_date', $year)
            ->whereMonth('meeting_date', $month)
            ->get();

        // 🔹 Group meetings by date (Y-m-d format)
        $meetingsByDate = $meetings->groupBy(function ($meeting) {
            return Carbon::parse($meeting->meeting_date)->format('Y-m-d');
        });

        // 🔹 Prepare all days of the month (even weekends)
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $days = [];

        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $currentDate = $date->format('Y-m-d');
            $dayName = $date->format('l');

            // ✅ Fetch meetings for this specific date
            $dayMeetings = $meetingsByDate->get($currentDate, collect());

            // ✅ Only skip non-working days if no meeting exists there
            if (!empty($workingDays) && !in_array($dayName, $workingDays) && $dayMeetings->isEmpty()) {
                continue;
            }

            // ✅ If meeting exists, add details
            if ($dayMeetings->isNotEmpty()) {
                foreach ($dayMeetings as $meeting) {
                    $status = strtolower($meeting->status ?? '');
                    $color = match ($status) {
                        'completed' => 'green',
                        'scheduled' => 'yellow',
                        'cancelled', 'canceled' => 'red',
                        default => 'gray'
                    };

                    $days[$currentDate][] = [
                        'weekend_schedule' => $selectedWeekend->title ?? 'Default Schedule',
                        'date' => $currentDate,
                        'day_name' => $dayName,
                        'title' => $meeting->purpose ?? 'N/A',
                        'meeting_type' => 'Single',
                        'status' => ucfirst($meeting->status ?? 'Unknown'),
                        'color' => $color,
                        'description' => $meeting->remarks ?? '--',
                        'visitor_name' => optional($meeting->visitor)->name ?? '--',
                        'employee_name' => optional($meeting->employee)->name ?? '--',
                    ];
                }
            } else {
                // ✅ Still add the day, just mark as “No Meeting”
                $days[$currentDate][] = [
                    'weekend_schedule' => $selectedWeekend->title ?? 'Default Schedule',
                    'date' => $currentDate,
                    'day_name' => $dayName,
                    'title' => 'No Meeting',
                    'meeting_type' => '--',
                    'status' => 'No Meeting',
                    'color' => 'lightgray',
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
            'weekendSchedules',
            'selectedWeekendId',
            'selectedWeekend'
        ));
    }
}
