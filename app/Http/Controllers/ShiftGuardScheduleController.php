<?php

namespace App\Http\Controllers;

use App\Models\ShiftGuardSchedule;
use Illuminate\Http\Request;

class ShiftGuardScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shiftSchedules = ShiftGuardSchedule::latest()->paginate(10);
        return view('schedule_management.guard_shift_schedule.index', compact('shiftSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedule_management.guard_shift_schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shift_name' => 'required|string|max:100',
            'start_time' => 'required',
            'end_time' => 'required|',
            'status' => 'required|string',
        ]);

        ShiftGuardSchedule::create($request->all());

        return redirect()->route('shift_guard_schedules.index')
            ->with('success', 'Shift schedule created successfully.');
    }

    public function show(ShiftGuardSchedule $shift_guard_schedule)
    {
        return view('schedule_management.guard_shift_schedule.show', compact('shift_guard_schedule'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShiftGuardSchedule $shift_guard_schedule)
    {
        return view('schedule_management.guard_shift_schedule.edit', compact('shift_guard_schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShiftGuardSchedule $shift_guard_schedule)
    {
        $request->validate([
            'shift_name' => 'required|string|max:100',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|string',
        ]);

        $shift_guard_schedule->update($request->all());

        return redirect()->route('shift_guard_schedules.index')
            ->with('success', 'Shift schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShiftGuardSchedule $shift_guard_schedule)
    {
        $shift_guard_schedule->delete();

        return redirect()->route('shift_guard_schedules.index')
            ->with('success', 'Shift schedule deleted successfully.');
    }
}
