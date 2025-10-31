<?php

namespace App\Http\Controllers;

use App\Models\OfficeSchedule;
use App\Models\Organization;
use Illuminate\Http\Request;

class OfficeScheduleController extends Controller
{
    public function index()
    {
        $schedules = OfficeSchedule::latest()->paginate(10);
        return view('schedule_management.office_schedule.index', compact('schedules'));
    }

    public function create()
    {
        $organizations = Organization::all();
        return view('schedule_management.office_schedule.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'schedule_name' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required|string',
        ]);

        OfficeSchedule::create($request->all());

        return redirect()->route('office_schedules.index')
            ->with('success', 'Office Schedule created successfully!');
    }

    public function show(OfficeSchedule $office_schedule)
    {
        return view('schedule_management.office_schedule.show', compact('office_schedule'));
    }

    public function edit(OfficeSchedule $office_schedule)
    {
        $organizations = Organization::all();
        return view('schedule_management.office_schedule.edit', compact('office_schedule', 'organizations'));
    }

    public function update(Request $request, OfficeSchedule $office_schedule)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'schedule_name' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required|string',
        ]);

        $office_schedule->update($request->all());

        return redirect()->route('office_schedules.index')
            ->with('success', 'Office Schedule updated successfully!');
    }

    public function destroy(OfficeSchedule $office_schedule)
    {
        $office_schedule->delete();
        return redirect()->route('office_schedules.index')
            ->with('success', 'Office Schedule deleted successfully!');
    }
}
