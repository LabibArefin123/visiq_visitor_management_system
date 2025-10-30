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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
