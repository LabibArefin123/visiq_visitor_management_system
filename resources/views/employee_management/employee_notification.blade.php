@extends('adminlte::page')

@section('title', 'Employee Notifications')

@section('content')
    <div class="container">
        <h2>Employee Notifications</h2>

        <!-- Search Form -->
        <div class="mb-3">
            <form method="GET" action="{{ route('employee.notifications') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by Name or Department"
                        value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <!-- Notification Table -->
        <div class="mb-3 d-flex justify-content-between">
            <h4>Late Check-In/Check-Out List</h4>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Department</th>
                    <th>Check-In Time</th>
                    <th>Check-Out Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->age }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->checkInTime ? \Carbon\Carbon::parse($employee->checkInTime)->format('H:i:s') : 'N/A' }}
                        </td>
                        <td>{{ $employee->checkOutTime ? \Carbon\Carbon::parse($employee->checkOutTime)->format('H:i:s') : 'N/A' }}
                        </td>
                        <td>{{ $employee->status }}</td>
                        <td>
                            @if ($employee->status !== 'On Time')
                                <form id="notifyForm-{{ $employee->id }}"
                                    action="{{ route('employee.notify', $employee->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="button" class="btn btn-warning btn-sm"
                                        onclick="confirmNotify({{ $employee->id }})">Notify</button>
                                </form>
                            @else
                                <span class="text-success">No Action Needed</span>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="mt-3">
            <h5>Total Employee Notifications: <span class="badge bg-danger">{{ $totalNotifications }}</span></h5>
        </div>

        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center">
        {{ $employees->appends(['search' => $search])->links() }}
    </div> --}}

    </div>
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmNotify(employeeId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to notify this employee.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Notify'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('notifyForm-' + employeeId).submit();
            }
        });
    }

    // Show success notification if session has success message
    @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ Session::get("success") }}',
            position: 'bottom-right',
            toast: true,
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    // Show error notification if session has error message
    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Failed!',
            text: '{{ Session::get("error") }}',
            position: 'bottom-right',
            toast: true,
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
@stop
