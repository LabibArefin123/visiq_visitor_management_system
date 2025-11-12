<?php

namespace App\Http\Controllers;

use App\Models\MeetingSchedule;
use App\Models\OfficeSchedule;
use App\Models\Organization;
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

        // Filter schedules by month/year
        $schedules = MeetingSchedule::whereYear('meeting_date', $year)
            ->whereMonth('meeting_date', $month)
            ->get();

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

        $startOfMonth = Carbon::createFromDate($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $days = [];

        // Office start & end
        $officeStart = Carbon::parse($selectedOffice->start_time);
        $officeEnd = Carbon::parse($selectedOffice->end_time);

        if ($officeEnd->lessThan($officeStart)) {
            $officeEnd->addDay();
        }

        // Loop through each day
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            for ($slot = $officeStart->copy(); $slot->lt($officeEnd); $slot->addHour()) {
                $nextSlot = $slot->copy()->addHour();

                $meeting = $schedules->first(function ($m) use ($date, $slot, $nextSlot, $selectedOffice) {
                    return $m->office_schedule_id == $selectedOffice->id &&
                        $m->meeting_date == $date->format('Y-m-d') &&
                        Carbon::parse($m->start_time)->betweenIncluded($slot, $nextSlot);
                });

                $days[] = [
                    'schedule_name' => $selectedOffice->schedule_name,
                    'date' => $date->format('Y-m-d'),
                    'day_name' => $date->format('l'),
                    'slot' => $slot->format('H:i A') . ' - ' . $nextSlot->format('H:i A'),
                    'title' => optional($meeting)->title ?? 'N/A',
                    'meeting_type' => optional($meeting)->meeting_type ?? 'N/A',
                    'status' => optional($meeting)->status ?? 'N/A',
                    'description' => optional($meeting)->description ?? 'N/A',
                    'id' => optional($meeting)->id,
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

    public function create()
    {
        return view('schedule_management.meeting_schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|',
            'meeting_type' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        MeetingSchedule::create($request->all());

        return redirect()->route('meeting_schedules.index')
            ->with('success', 'Meeting Schedule created successfully!');
    }

    public function show(MeetingSchedule $meetingSchedule)
    {
        return view('schedule_management.meeting_schedule.show', compact('meetingSchedule'));
    }

    public function edit(MeetingSchedule $meetingSchedule)
    {
        return view('schedule_management.meeting_schedule.edit', compact('meetingSchedule'));
    }

    public function update(Request $request, MeetingSchedule $meetingSchedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|',
            'meeting_type' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $meetingSchedule->update($request->all());

        return redirect()->route('meeting_schedules.index')
            ->with('success', 'Meeting Schedule updated successfully!');
    }

    public function destroy(MeetingSchedule $meetingSchedule)
    {
        $meetingSchedule->delete();
        return redirect()->route('meeting_schedules.index')
            ->with('success', 'Meeting Schedule deleted successfully!');
    }
}
