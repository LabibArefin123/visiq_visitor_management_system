@extends('adminlte::page')

@section('title', 'Employee Management')

@section('content')
    <div class="container">
        <h2>Employee Directory</h2>

        <!-- Search Form -->
        <div class="mb-3">
            <form method="GET" action="{{ route('employee_management') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search"
                        placeholder="Search by Name, National ID, or Department" value="{{ request()->get('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <!-- Employee Directory Table -->
        <div class="mb-3 d-flex justify-content-between">
            <h4>Employee List</h4>
            <div>
                <a href="{{ route('employee_management_create') }}" class="btn btn-success" id="add-employee-btn">Add
                    Employee</a>
                <a href="{{ route('check_in_employee_manual') }}" class="btn btn-primary" id="check-in-employee-btn">Check
                    In Employee</a>
            </div>
        </div>

        <script>
            // SweetAlert on Add Employee button
            document.getElementById('add-employee-btn').addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link action

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to add a new employee.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Add Employee',
                    cancelButtonText: 'No, Go Back'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = this.href; // Redirect to the add employee page if confirmed
                    } else {
                        Swal.fire('Cancelled', 'You did not add a new employee.', 'info');
                    }
                });
            });

            // SweetAlert on Check In Employee button
            document.getElementById('check-in-employee-btn').addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link action

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to check in an employee.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Check In Employee',
                    cancelButtonText: 'No, Go Back'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = this.href; // Redirect to the check-in page if confirmed
                    } else {
                        Swal.fire('Cancelled', 'You did not check in the employee.', 'info');
                    }
                });
            });
        </script>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="text-center">Profile</th>
                    <th>E_id</th>
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
                        <td>{{ $employee->E_id }}</td>
                        <td>{{ $employee->national_id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            @if ($employee->dob)
                                {{ \Carbon\Carbon::parse($employee->dob)->age }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $employee->dob ?? 'N/A' }}</td>
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
        <div class="d-flex justify-content-center">
            {{ $employees->appends(['search' => $search])->links() }}
        </div>

    </div>
@stop
