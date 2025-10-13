<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Visitor;
use App\Models\VisitorCompany;
use App\Models\VisitorGroupHostSchedule;
use App\Models\VisitorSchedule;
use Illuminate\Http\Request;

class VisitorGroupScheduleController extends Controller
{
    public function index()
    {
        $visitorSchedules = VisitorSchedule::with('visitor')->get();

        foreach ($visitorSchedules as $schedule) {
            $schedule->total_checkins = VisitorSchedule::where('v_id', $schedule->v_id)->count();
            $schedule->total_checkouts = VisitorSchedule::where('v_id', $schedule->v_id)
                ->whereNotNull('check_out_time')
                ->count();
        }


        return view('visitor_management.visitor_host_schedule', compact('visitorSchedules'));
    }

    public function create()
    {
        $visitors = Visitor::all();
        $employees = Employee::all();
        return view('visitor_management.visitor_host_schedule_add', compact('visitors', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'v_id' => 'required|exists:visitors,id',
            'employee_name' => 'required|string|max:255',
            'check_in_time' => 'required|date',
            'check_out_time' => 'nullable|date|after:check_in_time', // Optional field for check_out_time
        ]);

        // Create the VisitorSchedule
        VisitorSchedule::create([
            'v_id' => $request->v_id,
            'employee_name' => $request->employee_name,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time, // Store check_out_time if provided
        ]);

        return redirect()->route('visitor_schedule.index')->with('success', 'Schedule added successfully!');
    }

    public function view($id)
    {
        // Fetch the schedule by ID along with the associated visitor
        $schedule = VisitorSchedule::with('visitor')->findOrFail($id);

        // Return the view with the schedule data
        return view('visitor_management.visitor_host_view', compact('schedule'));
    }

    public function edit($id)
    {
        // Fetch the schedule by ID along with the associated visitor
        $schedule = VisitorSchedule::with('visitor')->findOrFail($id);
        $visitors = Visitor::all();  // Fetch all visitors for the select dropdown

        // Return the edit view with schedule and visitors data
        return view('visitor_management.visitor_host_schedule_edit', compact('schedule', 'visitors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'v_id' => 'required|exists:visitors,id',
            'employee_name' => 'required|string|max:255',
            'check_in_time' => 'required|date',
            'check_out_time' => 'nullable|date|after:check_in_time',
        ]);

        // Find the schedule by ID
        $schedule = VisitorSchedule::findOrFail($id);

        // Update schedule details
        $schedule->update([
            'v_id' => $request->v_id, // Ensure it's storing visitor_id
            'employee_name' => $request->employee_name,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
        ]);

        return redirect()->route('visitor_schedule.index')->with('success', 'Schedule updated successfully!');
    }


    public function destroy($id)
    {
        // Find the schedule by ID
        $schedule = VisitorSchedule::findOrFail($id);

        // Delete the schedule
        $schedule->delete();

        // Redirect back to the schedule list with a success message
        return redirect()->route('visitor_schedule.index')->with('success', 'Schedule deleted successfully!');
    }

    public function visitor_group_schedule_index()
    {
        $groupSchedules = VisitorGroupHostSchedule::all();
        return view('visitor_management.visitor_group_host_schedule_index', compact('groupSchedules'));
    }

    public function visitor_group_schedule_create()
    {
        $companies = VisitorCompany::all(); // Fetch all companies
        $employees = Employee::all(); // Fetch all employees

        return view('visitor_management.visitor_group_host_schedule_add', compact('companies', 'employees'));
    }

    public function visitor_group_schedule_store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'employee_name' => 'required|string|max:255',
            'check_in_time' => 'required|date',
            'check_out_time' => 'nullable|date|after:check_in_time',
        ]);

        VisitorGroupHostSchedule::create([
            'company_name' => $request->company_name,
            'employee_name' => $request->employee_name,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
        ]);

        return redirect()->route('visitor_schedule.group.index')->with('success', 'Group Schedule added successfully!');
    }

    public function visitor_group_schedule_edit($id)
    {
        $groupSchedule = VisitorGroupHostSchedule::findOrFail($id);
        $companies = VisitorCompany::all();
        $employees = Employee::all();

        return view('visitor_management.visitor_group_host_schedule_edit', compact('groupSchedule', 'companies', 'employees'));
    }

    public function visitor_group_schedule_update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'employee_name' => 'required|string|max:255',
            'check_in_time' => 'required|date',
            'check_out_time' => 'nullable|date|after:check_in_time',
        ]);

        $groupSchedule = VisitorGroupHostSchedule::findOrFail($id);
        $groupSchedule->update([
            'company_name' => $request->company_name,
            'employee_name' => $request->employee_name,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
        ]);

        return redirect()->route('visitor_schedule.group.index')->with('success', 'Group Schedule updated successfully!');
    }

    public function visitor_group_schedule_delete($id)
    {
        $groupSchedule = VisitorGroupHostSchedule::findOrFail($id);
        $groupSchedule->delete();

        return redirect()->route('visitor_schedule.group.index')->with('success', 'Group Schedule deleted successfully!');
    }
}
