@extends('adminlte::page')

@section('title', 'Add Group Visitor Schedule')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Add Group Visitor Host Schedule</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Schedule multiple visitors with their host.</p>

        <!-- Form to Add Group Schedule -->
        <form action="{{ route('visitor_schedule.group.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Company Name:</label>
                <select name="company_name" class="form-control" required>
                    <option value="">Select a Company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Host/Employee Name:</label>
                <select name="employee_name" class="form-control" required>
                    <option value="">Select an Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-in Time:</label>
                <input type="datetime-local" name="check_in_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out Time (Optional):</label>
                <input type="datetime-local" name="check_out_time" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save Group Schedule</button>
        </form>
    </div>
@endsection
