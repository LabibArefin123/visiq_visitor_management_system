<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display all employees
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return view('employee_management.index', compact('employees'));
    }

    // Show create form
    public function create()
    {
        return view('employee_management.create');
    }

    // Store employee
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|unique:employees,emp_id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'national_id' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    // Show employee details
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee_management.show', compact('employee'));
    }

    // Show edit form
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    // Update employee
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'emp_id' => 'required|unique:employees,emp_id,' . $employee->id,
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'national_id' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    // Delete employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
