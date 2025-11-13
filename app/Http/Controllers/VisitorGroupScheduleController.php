<?php

namespace App\Http\Controllers;

use App\Models\VisitorGroupSchedule;
use App\Models\VisitorGroupMember;
use App\Models\Employee;
use Illuminate\Http\Request;

class VisitorGroupScheduleController extends Controller
{
    public function index()
    {
        $schedules = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
            ->orderBy('meeting_date', 'asc')
            ->get();

        return view('schedule_management.visitor_group_schedule.index', compact('schedules'));
    }

    public function create()
    {
        // Sort visitors by 'purpose_type' ascending
        $gVisitors = VisitorGroupMember::orderBy('group_name')->get();
        $employees = Employee::orderBy('name')->get(); // optional, sorted by name

        return view('schedule_management.visitor_group_schedule.create', compact('gVisitors', 'employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'visitor_group_id' => 'required|exists:visitor_group_members,id',
            'employee_id' => 'required|exists:employees,id',
            'meeting_date' => 'required|date',
            'purpose' => 'required|string',
            'status' => 'required|string',
        ]);

        VisitorGroupSchedule::create($request->all());

        return redirect()->route('visitor_group_schedules.index')->with('success', 'Visitor Group Schedule created successfully.');
    }

    public function show(VisitorGroupSchedule $visitor_group_schedule)
    {
        return view('schedule_management.visitor_group_schedule.show', compact('visitor_group_schedule'));
    }

    public function edit(VisitorGroupSchedule $visitor_group_schedule)
    {
        $gVisitors = VisitorGroupMember::orderBy('group_name')->get();
        $employees = Employee::all();
        return view('schedule_management.visitor_group_schedule.edit', compact('visitor_group_schedule', 'gVisitors', 'employees'));
    }

    public function update(Request $request, VisitorGroupSchedule $visitor_group_schedule)
    {
        $request->validate([
            'visitor_group_id' => 'required|exists:visitor_group_members,id',
            'employee_id' => 'required|exists:employees,id',
            'meeting_date' => 'required|date',
            'purpose' => 'required|string',
            'status' => 'required|string',
        ]);

        $visitor_group_schedule->update($request->all());

        return redirect()->route('visitor_group_schedules.index')->with('success', 'Visitor Group Schedule updated successfully.');
    }

    public function destroy(VisitorGroupSchedule $visitor_group_schedule)
    {
        $visitor_group_schedule->delete();

        return redirect()->route('visitor_group_schedules.index')->with('success', 'Visitor Group Schedule deleted successfully.');
    }
}
