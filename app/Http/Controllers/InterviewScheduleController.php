<?php

namespace App\Http\Controllers;

use App\Models\InterviewSchedule;
use App\Models\VisitorJobApplication;
use App\Models\Employee;
use Illuminate\Http\Request;

class InterviewScheduleController extends Controller
{
    public function index()
    {
        $interviewSchedules = InterviewSchedule::with('employee', 'candidate')->orderBy('interview_date', 'desc')->get();
        return view('schedule_management.interview_schedule.index', compact('interviewSchedules'));
    }

    public function create()
    {
        $employees = Employee::orderBy('name', 'asc')->get();
        $candidates = VisitorJobApplication::orderBy('name', 'asc')->get();
        return view('schedule_management.interview_schedule.create', compact('employees', 'candidates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_name' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'interview_date' => 'required|date',
            'position' => 'required|string|max:255',
            'status' => 'required|in:pending,completed,cancelled',
            'remarks' => 'nullable|string',
        ]);

        InterviewSchedule::create($request->all());

        return redirect()->route('interview_schedules.index')->with('success', 'Interview schedule created successfully.');
    }

    public function show(InterviewSchedule $interviewSchedule)
    {
        return view('schedule_management.interview_schedule.show', compact('interviewSchedule'));
    }

    public function edit(InterviewSchedule $interviewSchedule)
    {
        $employees = Employee::orderBy('name', 'asc')->get();
        $candidates = VisitorJobApplication::orderBy('name', 'asc')->get();
        return view('schedule_management.interview_schedule.edit', compact('interviewSchedule', 'employees', 'candidates'));
    }

    public function update(Request $request, InterviewSchedule $interviewSchedule)
    {
        $request->validate([
            'candidate_name' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'interview_date' => 'required|date',
            'position' => 'required|string|max:255',
            'status' => 'required|in:pending,completed,cancelled',
            'remarks' => 'nullable|string',
        ]);

        $interviewSchedule->update($request->all());

        return redirect()->route('interview_schedules.index')->with('success', 'Interview schedule updated successfully.');
    }

    public function destroy(InterviewSchedule $interviewSchedule)
    {
        $interviewSchedule->delete();
        return redirect()->route('interview_schedules.index')->with('success', 'Interview schedule deleted successfully.');
    }
}
