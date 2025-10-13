<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\CheckInEmployee;
use App\Models\CheckOutEmployee;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\Attendance;
use App\Models\EmployeeNotification;
use App\Models\Visitor;
use App\Models\VisitorToEmployee;
use Illuminate\Support\Facades\Session;

class Employee_Management extends Controller
{
    public function employee_management(Request $request)
    {
        // Search employees
        $search = $request->get('search');
        $employees = Employee::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('department', 'like', "%{$search}%");
        })->paginate(10);

        return view('employee_management.employee_management_index', compact('employees', 'search'));
    }

    public function showCheckInPage()
    {
        // Fetch employees who have not checked in today
        $users = Employee::whereDoesntHave('attendance', function ($query) {
            $query->whereDate('date', today())->whereNotNull('check_in');
        })->get();

        return view('employee_management.check_in_employee', compact('users'));
    }

    public function checkInEmployee(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Record the check-in
        Attendance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'date' => today(),
            ],
            [
                'check_in' => now(),
            ]
        );

        return redirect()->route('check_in_employee_try')->with('success', 'Employee checked in successfully!');
    }



    public function expected_checkout_employee(Request $request)
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
            $expectedCheckOutTime = $employee->expected_checkout_time
                ? \Carbon\Carbon::parse($employee->expected_checkout_time)
                : \Carbon\Carbon::createFromTime(21, 0);

            // Determine the status
            $status = $checkOutTime->lte($expectedCheckOutTime) ? 'Regular' : 'Overdue';

            // Store the check-out record
            CheckOutEmployee::create([
                'employee_id' => $employee->id,
                'name' => $employee->name,
                'age' => $employee->age,
                'department' => $employee->department,
                'check_out_time' => $validated['check_out_time'],
                'status' => $status,
            ]);

            // Increment total_checkouts for the employee
            $employee->increment('total_checkouts');

            return redirect()->route('check_out_employee')->with('success', 'Employee checked out successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing the check-out.']);
        }
    }


    public function check_out_employee(Request $request)
    {
        // Fetch all employee check-out records
        $search = $request->input('search');

        // Fetch filtered records if search exists, otherwise fetch all records
        $checkOutEmployees = CheckOutEmployee::with('employee')
            ->whereHas('employee', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('department', 'LIKE', "%{$search}%");
                }
            })
            ->get();

        return view('employee_management.check_out_employee', compact('checkOutEmployees', 'search'));
    }

    /**
     * Show the attendance tracking page.
     */
    public function attendance_tracking(Request $request)
    {
        $search = $request->get('search');

        // Fetch employees with optional search
        $attendanceRecords = Employee::with(['checkIn', 'checkOut'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->paginate(10);

        return view('employee_management.attendance_tracking_index', compact('attendanceRecords'));
    }
    public function check_in($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        CheckInEmployee::create([
            'employee_id' => $employee->id,
            'name' => $employee->name,
            'age' => $employee->age,
            'department' => $employee->department,
            'check_in_time' => now(),
            'status' => 'On Time', // Default to "On Time"
        ]);

        return redirect()->route('attendance_tracking')->with('success', "{$employee->name} checked in successfully.");
    }

    /**
     * Check out an employee.
     */
    public function check_Out($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        CheckOutEmployee::create([
            'employee_id' => $employee->id,
            'name' => $employee->name,
            'age' => $employee->age,
            'department' => $employee->department,
            'check_out_time' => now(),
            'status' => now()->greaterThan(\Carbon\Carbon::createFromTime(21, 0)) ? 'Late' : 'On Time',
        ]);

        return redirect()->route('attendance_tracking')->with('success', "{$employee->name} checked out successfully.");
    }

    /**
     * Show the roles and permissions management page.
     */
    public function roles_and_permissions()
    {
        $roles = Role::all();
        return view('employee_management.roles_and_permission_index', compact('roles'));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee_management.employee_management_view', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee_management.employee_management_edit', compact('employee'));
    }

    public function employee_create()
    {
        return view('employee_management.employee_management_create');
    }

    public function store(Request $request)
    {
        // Validation for the input fields
        $request->validate([
            'E_id' => 'required|string|unique:employees,E_id|max:20', // Employee ID validation
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:20|unique:employees,national_id', // Ensure unique National ID
            'dob' => 'required|date|before:today', // Ensure DOB is valid
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:employees,email', // Email validation
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image validation
        ]);

        // Calculate age based on DOB
        $dob = $request->dob;
        $age = \Carbon\Carbon::parse($dob)->age;

        // Handle Profile Photo Upload
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profiles', 'public');
        }

        // Create the employee record
        Employee::create([
            'E_id' => $request->E_id,  // Employee ID
            'name' => $request->name,
            'national_id' => $request->national_id, // Store the national_id
            'dob' => $dob,
            'age' => $age,  // Store calculated age
            'department' => $request->department,
            'phone' => $request->phone,
            'email' => $request->email,
            'profile_picture' => $profilePhotoPath,  // Save profile photo path
        ]);

        return redirect()->route('employee_management')->with('success', 'Employee added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validation for the input fields
        $request->validate([
            'E_id' => 'required|string|max:20|unique:employees,E_id,' . $id, // Unique Employee ID validation
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:20|unique:employees,national_id,' . $id, // Allow editing of national_id with uniqueness check
            'dob' => 'required|date|before:today', // Ensure DOB is valid
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:employees,email,' . $id, // Ignore current employee for uniqueness
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image validation
        ]);

        $employee = Employee::findOrFail($id);

        // Calculate age based on DOB
        $dob = $request->dob;
        $age = \Carbon\Carbon::parse($dob)->age;

        // Handle Profile Photo Upload
        if ($request->hasFile('profile_photo')) {
            $profilePath = $request->file('profile_photo')->store('profiles', 'public');
            $employee->profile_picture = $profilePath;
        }

        // Update other fields, including national_id
        $employee->update([
            'E_id' => $request->E_id,  // Update Employee ID
            'name' => $request->name,
            'national_id' => $request->national_id, // Update national_id
            'dob' => $dob,
            'age' => $age,  // Update with new calculated age
            'department' => $request->department,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('employee_management')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employee_management')->with('success', 'Employee deleted successfully!');
    }


    public function role_index()
    {
        $users = User::all();  // Get all employees
        $roles = Role::all();  // Get all roles
        $permissions = Permission::all();  // Get all permissions
        return view('employee_management.roles_and_permission_index', compact('users', 'roles', 'permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function removeRole(Request $request)
    {
        $request->validate(['role' => 'required|exists:roles,name']);
        Role::where('name', $request->role)->delete();

        return redirect()->route('roles.index')->with('success', 'Role removed successfully.');
    }

    public function removePermission(Request $request)
    {
        $request->validate(['permission' => 'required|exists:permissions,name']);
        Permission::where('name', $request->permission)->delete();

        return redirect()->route('roles.index')->with('success', 'Permission removed successfully.');
    }

    // Assign role to employee
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::where('name', $request->role)->first();

        // Assign the role to the user
        $user->roles()->syncWithoutDetaching([$role->id]);

        return redirect()->route('roles.index')->with('success', 'Role assigned to employee successfully.');
    }

    // Assign permissions to role
    public function assignPermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::find($request->role_id);
        $permissions = Permission::whereIn('name', $request->permissions)->get();
        $role->permissions()->sync($permissions);  // Sync permissions with the role

        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully.');
    }

    public function employee_notifications()
    {
        $employees = Employee::with(['checkIn', 'checkOut'])
            ->get()
            ->map(function ($employee) {
                $checkInTime = $employee->checkIn ? $employee->checkIn->check_in_time : null;
                $checkOutTime = $employee->checkOut ? $employee->checkOut->check_out_time : null;

                $status = '';
                if ($checkInTime && \Carbon\Carbon::parse($checkInTime)->hour > 9) {
                    $status = 'Late Check-In';
                }
                if ($checkOutTime && \Carbon\Carbon::parse($checkOutTime)->hour >= 21) {
                    $status = $status ? $status . ', Late Check-Out' : 'Late Check-Out';
                }

                return (object) [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'age' => $employee->age,
                    'department' => $employee->department,
                    'checkInTime' => $checkInTime,
                    'checkOutTime' => $checkOutTime,
                    'status' => $status ?: 'On Time',
                ];
            });

        // Count the total late check-ins or check-outs
        $totalNotifications = $employees->filter(function ($employee) {
            return $employee->status !== 'On Time';
        })->count();

        return view('employee_management.employee_notification', compact('employees', 'totalNotifications'));
    }


    public function employeeApproval()
    {
        $approvedEmployees = VisitorToEmployee::where('status', 'Approved')->with(['visitor', 'employee'])->get();

        // Pass the data to the view
        return view('employee_management.employee_approval', compact('approvedEmployees'));
    }

    public function approveEmployee($id)
    {
        $visitor = Visitor::findOrFail($id);

        // Convert visitor to employee
        Employee::create([
            'name'       => $visitor->name,
            'phone'      => $visitor->phone,
            'email'      => $visitor->email,
            'department' => $visitor->purpose, // Example: use purpose as department
        ]);

        $visitor->status = 'approved';
        $visitor->save();

        return redirect()->route('employee_approval')->with('success', 'Visitor approved and added as an employee!');
    }

    public function declineEmployee($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->status = 'declined';
        $visitor->save();

        return redirect()->route('employee_management.employee_approval')->with('success', 'Visitor declined successfully!');
    }

    public function notify_employee(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            // Insert notification record
            EmployeeNotification::create([
                'employee_id' => $employee->id,
                'status' => 'Notified for Late Check-In/Check-Out',
                'notified_at' => now(),
            ]);

            // Flash success message
            Session::flash('success', 'Notified employee successfully!');

            return redirect()->route('home'); // Redirect to home
        } catch (\Exception $e) {
            Session::flash('error', 'Notification failed!');

            return redirect()->back(); // Stay on the same page if failed
        }
    }
}
