<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = EmployeeAttendance::with('employee')
            ->orderBy('check_in_date', 'asc')
            ->paginate(10);

        return view('employee_management.attendance.index', compact('attendances'));
    }

    public function checkInEmployees()
    {
        $attendances = EmployeeAttendance::with('employee')
            ->whereNotNull('check_in_time')
            ->orderBy('check_in_date', 'asc')
            ->paginate(10);

        return view('employee_management.attendance.check_in_employee', compact('attendances'));
    }

    public function checkOutEmployees()
    {
        $attendances = EmployeeAttendance::with('employee')
            ->whereNotNull('check_out_time')
            ->orderBy('check_in_date', 'asc')
            ->paginate(10);

        return view('employee_management.attendance.check_out_employee', compact('attendances'));
    }
}
