<?php

namespace App\Http\Controllers;

use App\Models\WeekendSchedule;
use Illuminate\Http\Request;

class WeekendScheduleController extends Controller
{
    public function index()
    {
        $weekendSchedules = WeekendSchedule::orderBy('id', 'asc')->get();
        return view('schedule_management.weekend_schedule.index', compact('weekendSchedules'));
    }

    public function create()
    {
        return view('schedule_management.weekend_schedule.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slot_name' => 'required|string|max:255',
            'working_days' => 'required|array|min:1',
            'status' => 'required|string',
        ]);

        WeekendSchedule::create([
            'slot_name' => $validated['slot_name'],
            'working_days' => json_encode($validated['working_days']),
            'status' => $validated['status'],
        ]);

        return redirect()->route('weekend_schedules.index')->with('success', 'Weekend schedule added successfully.');
    }

    public function show(WeekendSchedule $weekendSchedule)
    {
        return view('schedule_management.weekend_schedule.show', compact('weekendSchedule'));
    }

    public function edit(WeekendSchedule $weekendSchedule)
    {
        return view('schedule_management.weekend_schedule.edit', compact('weekendSchedule'));
    }

    public function update(Request $request, WeekendSchedule $weekendSchedule)
    {
        $validated = $request->validate([
            'slot_name' => 'required|string|max:255',
            'working_days' => 'required|array|min:1',
            'status' => 'required|string',
        ]);

        $weekendSchedule->update([
            'slot_name' => $validated['slot_name'],
            'working_days' => json_encode($validated['working_days']),
            'status' => $validated['status'],
        ]);

        return redirect()->route('weekend_schedules.index')->with('success', 'Weekend schedule updated successfully.');
    }

    public function destroy(WeekendSchedule $weekendSchedule)
    {
        $weekendSchedule->delete();
        return redirect()->route('weekend_schedules.index')->with('success', 'Weekend schedule deleted successfully.');
    }
}
