<?php

namespace App\Http\Controllers;

use App\Models\VisitorHostSchedule;
use App\Models\Visitor;
use App\Models\Employee;
use Illuminate\Http\Request;

class VisitorHostScheduleController extends Controller
{
    public function index()
    {
        $schedules = VisitorHostSchedule::with(['visitor', 'employee'])
            ->orderBy('meeting_date', 'asc')
            ->get();

        return view('schedule_management.visitor_host_schedule.index', compact('schedules'));
    }

    public function create()
    {
        // Sort visitors by 'purpose_type' ascending
        $visitors = Visitor::orderBy('purpose')->orderBy('name')->get();
        $employees = Employee::orderBy('name')->get(); // optional, sorted by name

        return view('schedule_management.visitor_host_schedule.create', compact('visitors', 'employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'employee_id' => 'required|exists:employees,id',
            'meeting_date' => 'required|date',
            'purpose' => 'required|string',
            'status' => 'required|string',
        ]);

        VisitorHostSchedule::create($request->all());

        return redirect()->route('visitor_host_schedules.index')->with('success', 'Visitor Host Schedule created successfully.');
    }

    public function show(VisitorHostSchedule $visitor_host_schedule)
    {
        return view('schedule_management.visitor_host_schedule.show', compact('visitor_host_schedule'));
    }

    public function edit(VisitorHostSchedule $visitor_host_schedule)
    {
        $visitors = Visitor::orderBy('purpose')->orderBy('name')->get();
        $employees = Employee::all();
        return view('schedule_management.visitor_host_schedule.edit', compact('visitor_host_schedule', 'visitors', 'employees'));
    }

    public function update(Request $request, VisitorHostSchedule $visitor_host_schedule)
    {
        $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'employee_id' => 'required|exists:employees,id',
            'meeting_date' => 'required|date',
            'purpose' => 'required|string',
            'status' => 'required|string',
        ]);

        $visitor_host_schedule->update($request->all());

        return redirect()->route('visitor_host_schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(VisitorHostSchedule $visitor_host_schedule)
    {
        $visitor_host_schedule->delete();

        return redirect()->route('visitor_host_schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
