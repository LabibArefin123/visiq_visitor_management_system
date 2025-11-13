<?php

namespace App\Http\Controllers;

use App\Models\VisitorHostSchedule;
use App\Models\VisitorGroupSchedule;
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

        $weekendSchedules = WeekendSchedule::where('status', 'Active')->get();
        $selectedWeekend = $selectedWeekendId
            ? $weekendSchedules->firstWhere('id', $selectedWeekendId)
            : $weekendSchedules->first();

        $workingDays = [];
        if ($selectedWeekend && !empty($selectedWeekend->working_days)) {
            $workingDays = array_map('trim', explode(',', $selectedWeekend->working_days));
        }

        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // 🔹 Fetch all single meetings for this month
        $singleMeetings = VisitorHostSchedule::with(['visitor', 'employee'])
            ->whereYear('meeting_date', $year)
            ->whereMonth('meeting_date', $month)
            ->get();

        // 🔹 Fetch all group meetings for this month
        $groupMeetings = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
            ->whereYear('meeting_date', $year)
            ->whereMonth('meeting_date', $month)
            ->get();

        // 🔹 Group by date
        $singleByDate = $singleMeetings->groupBy(fn($m) => Carbon::parse($m->meeting_date)->format('Y-m-d'));
        $groupByDate = $groupMeetings->groupBy(fn($m) => Carbon::parse($m->meeting_date)->format('Y-m-d'));

        // 🔹 Prepare all days of the month
        $days = [];
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $currentDate = $date->format('Y-m-d');
            $dayName = $date->format('l');

            $days[$currentDate] = [];

            // Skip non-working days only if no meeting exists
            $daySingleMeetings = $singleByDate->get($currentDate, collect());
            $dayGroupMeetings = $groupByDate->get($currentDate, collect());

            if (
                !empty($workingDays) && !in_array($dayName, $workingDays) &&
                $daySingleMeetings->isEmpty() && $dayGroupMeetings->isEmpty()
            ) {
                continue;
            }

            // Add single meetings
            foreach ($daySingleMeetings as $m) {
                $status = strtolower($m->status ?? '');
                $days[$currentDate][] = [
                    'id' => $m->id, // 🔹 add this
                    'weekend_schedule' => $selectedWeekend->title ?? 'Default Schedule',
                    'date' => $currentDate,
                    'day_name' => $dayName,
                    'title' => $m->purpose ?? 'N/A',
                    'meeting_type' => 'Single',
                    'status' => ucfirst($m->status ?? 'Unknown'),
                    'color' => match ($status) {
                        'completed' => 'green',
                        'scheduled' => 'yellow',
                        'cancelled', 'canceled' => 'red',
                        default => 'gray',
                    },
                    'description' => $m->remarks ?? '--',
                    'visitor_name' => optional($m->visitor)->name ?? '--',
                    'employee_name' => optional($m->employee)->name ?? '--',
                ];
            }

            // Add group meetings
            foreach ($dayGroupMeetings as $m) {
                $status = strtolower($m->status ?? '');
                $days[$currentDate][] = [
                    'id' => $m->id, // 🔹 add this
                    'weekend_schedule' => $selectedWeekend->title ?? 'Default Schedule',
                    'date' => $currentDate,
                    'day_name' => $dayName,
                    'title' => $m->purpose ?? 'N/A',
                    'meeting_type' => 'Group',
                    'status' => ucfirst($m->status ?? 'Unknown'),
                    'color' => match ($status) {
                        'completed' => 'green',
                        'scheduled' => 'yellow',
                        'cancelled', 'canceled' => 'red',
                        default => 'gray',
                    },
                    'description' => $m->remarks ?? '--',
                    'visitor_name' => optional($m->visitorGroup)->group_name ?? '--',
                    'employee_name' => optional($m->employee)->name ?? '--',
                ];
            }

            // If no meeting, mark as No Meeting
            if (empty($days[$currentDate])) {
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
