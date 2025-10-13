<?php

namespace App\Http\Controllers;

use App\Models\CheckInEmployee;
use App\Models\CheckOutEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;

class Employee_Attendance extends Controller
{
    public function checkin_manual()
    {
        // Validate the incoming data
        $employees = Employee::all();

        return view('employee_management.check_in_employee_manual', compact('employees'));
    }

    public function checkout_manual()
    {
        // Validate the incoming data
        $employees = Employee::all();
        return view('employee_management.check_out_employee_manual', compact('employees'));
    }

    public function checkin(Request $request)
    {
        // Optional search functionality
        $search = $request->get('search', '');

        // Fetch employees who have checked in
        $checkInEmployees = CheckInEmployee::with('employee') // Load related employee data
            ->when($search, function ($query, $search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('department', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10); // Paginate results

        // Sum the total_checkins column
        $totalEmployeeCheckIn = CheckInEmployee::sum('total_checkins');

        return view('employee_management.check_in_employee', compact('checkInEmployees', 'search', 'totalEmployeeCheckIn'));
    }


    public function checkout(Request $request)
    {
        // Optional search functionality
        $search = $request->get('search', '');

        // Fetch employees who have checked out
        $checkOutEmployees = CheckOutEmployee::with('employee') // Load related employee data
            ->when($search, function ($query, $search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('department', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10); // Paginate results

        // Sum the total_checkouts column
        $totalEmployeeCheckOut = CheckOutEmployee::sum('total_checkouts');

        return view('employee_management.check_out_employee', compact('checkOutEmployees', 'search', 'totalEmployeeCheckOut'));
    }

    public function checkin_employee_store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in_time' => 'required|date_format:H:i', // Validate input time format
        ]);

        try {
            // Fetch the employee
            $employee = Employee::findOrFail($validated['employee_id']);

            // Parse the check-in time
            $checkInTime = \Carbon\Carbon::createFromFormat('H:i', $validated['check_in_time']);

            // Determine the status
            $status = $checkInTime->between(\Carbon\Carbon::createFromTime(8, 0), \Carbon\Carbon::createFromTime(9, 0))
                ? 'Regular'
                : ($checkInTime->hour > 9 ? 'Regular' : 'Late');

            // Check if an entry already exists for today
            $existingCheckin = CheckInEmployee::where('employee_id', $employee->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($existingCheckin) {
                // Update existing record
                $existingCheckin->update([
                    'check_in_time' => $validated['check_in_time'],
                    'status' => $status,
                    'total_checkins' => $existingCheckin->total_checkins + 1, // Increment total check-ins
                ]);
            } else {
                // Create new check-in entry
                CheckInEmployee::create([
                    'employee_id' => $employee->id,
                    'name' => $employee->name,
                    'age' => $employee->age,
                    'department' => $employee->department,
                    'check_in_time' => $validated['check_in_time'],
                    'status' => $status,
                    'total_checkins' => 1, // Start count from 1
                ]);
            }

            return redirect()->route('check_in_employee')->with('success', 'Employee checked in successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing the check-in.']);
        }
    }


    public function checkout_employee_store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id', // Ensure the employee exists
            'check_out_time' => 'required|date_format:H:i', // Manual check-out time
        ]);

        try {
            // Find the employee record
            $employee = Employee::findOrFail($validated['employee_id']);

            // Parse the check-out time
            $checkOutTime = \Carbon\Carbon::createFromFormat('H:i', $validated['check_out_time']);

            $expectedCheckOutTime = \Carbon\Carbon::createFromTime(21, 0); // 9:00 PM


            // Determine the status
            $status = $checkOutTime->lte(\Carbon\Carbon::createFromTime(21, 0)) ? 'Regular' : 'Late';

            // Check if an entry already exists for today
            $existingCheckout = CheckOutEmployee::where('employee_id', $employee->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($existingCheckout) {
                // Update existing record
                $existingCheckout->update([
                    'check_out_time' => $validated['check_out_time'],
                    'status' => $status,
                    'total_checkouts' => $existingCheckout->total_checkouts + 1, // Increment total checkouts
                ]);
            } else {
                // Create new check-out entry
                CheckOutEmployee::create([
                    'employee_id' => $employee->id,
                    'name' => $employee->name,
                    'age' => $employee->age,
                    'department' => $employee->department,
                    'expected_check_out_time' => $expectedCheckOutTime->format('H:i'), // Fixed 9 PM
                    'check_out_time' => $validated['check_out_time'],
                    'status' => $status,
                    'total_checkouts' => 1, // Start count from 1
                ]);
            }

            return redirect()->route('check_out_employee')->with('success', 'Employee checked out successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing the check-out.']);
        }
    }
}
