<?php

namespace App\Http\Controllers;

use App\Models\ShiftSchedule;
use Illuminate\Http\Request;

class ShiftScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shiftSchedules = ShiftSchedule::latest()->get();
        return view('schedule_management.shift_schedule.index', compact('shiftSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedule_management.shift_schedule.create');
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

        ShiftSchedule::create($request->all());

        return redirect()->route('shift_schedules.index')
            ->with('success', 'Shift schedule created successfully.');
    }

    public function show(ShiftSchedule $shiftSchedule)
    {
        return view('schedule_management.shift_schedule.show', compact('shiftSchedule'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShiftSchedule $shiftSchedule)
    {
        return view('schedule_management.shift_schedule.edit', compact('shiftSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShiftSchedule $shiftSchedule)
    {
        $request->validate([
            'shift_name' => 'required|string|max:100',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|string',
        ]);

        $shiftSchedule->update($request->all());

        return redirect()->route('shift_schedules.index')
            ->with('success', 'Shift schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShiftSchedule $shiftSchedule)
    {
        $shiftSchedule->delete();

        return redirect()->route('shift_schedules.index')
            ->with('success', 'Shift schedule deleted successfully.');
    }
}
