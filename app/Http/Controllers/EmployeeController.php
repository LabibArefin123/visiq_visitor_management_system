<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return view('employee_management.index', compact('employees'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee_management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|string|unique:employees,emp_id|max:20',
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:20|unique:employees,national_id',
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:employees,email',
        ]);

        Employee::create($request->only([
            'emp_id',
            'name',
            'national_id',
            'department',
            'phone',
            'email',
        ]));

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee_management.employee_management_view', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee_management.employee_management_edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'emp_id' => 'required|string|max:20|unique:employees,emp_id,' . $employee->id,
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:20|unique:employees,national_id,' . $employee->id,
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
        ]);

        $employee->update($request->only([
            'emp_id',
            'name',
            'national_id',
            'department',
            'phone',
            'email',
        ]));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
