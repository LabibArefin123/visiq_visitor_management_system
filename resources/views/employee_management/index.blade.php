@extends('adminlte::page')

@section('title', 'Employee Management')

@section('content')
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>National ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td class="text-center">
                            <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : asset('images/default.jpg') }}"
                                alt="Profile Picture" class="rounded-circle mx-auto d-block" width="50" height="50">
                        </td>
                        <td>{{ $employee->emp_id }}</td>
                        <td>{{ $employee->national_id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            @if ($employee->date_of_birth)
                                {{ \Carbon\Carbon::parse($employee->date_of_birth)->age }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $employee->date_of_birth ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $employee->links('pagination::bootstrap-5') }}
        </div>

    </div>
@stop
