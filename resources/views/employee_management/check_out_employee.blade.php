@extends('adminlte::page')

@section('title', 'Check-Out Employee')

@section('content')
    <div class="container">
        <h2>Check-Out Employee</h2>

        <!-- Search Form -->
        <div class="mb-3">
            <form method="GET" action="{{ route('check_out_employee') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by Name or Department"
                        value="{{ request()->get('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <!-- Employee Check-Out Table -->
        <div class="mb-3 d-flex justify-content-between">
            <h4>Employee List</h4>
            <div>
                <button class="btn btn-primary" onclick="confirmCheckOut()">Check Out Employee</button>
            </div>
        </div>

        {{-- SweetAlert2 Confirmation --}}
        

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>EID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Department</th>
                    <th>Expected Check-Out</th> <!-- Fixed 9:00 PM -->
                    <th>Check-Out Time</th>
                    <th>Status</th>
                    <th>Total Check Out</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($checkOutEmployees as $checkOut)
                    @php
                        // **Expected Check-Out Time is always 9:00 PM**
                        $expectedCheckOutTime = '21:00';

                        // Parse actual check-out time
                        $checkOutTime = $checkOut->check_out_time
                            ? \Carbon\Carbon::parse($checkOut->check_out_time)->format('Y-m-d h:i A') : 'N/A';
                        $status = $checkOut->status ?? 'Pending';
                    @endphp
                    <tr>
                        <td>{{ $checkOut->employee->id }}</td>
                        <td>{{ $checkOut->employee->E_id }}</td>
                        <td>{{ $checkOut->employee->name }}</td>
                        <td>{{ $checkOut->employee->age }}</td>
                        <td>{{ $checkOut->employee->department }}</td>
                        <td>{{ $expectedCheckOutTime }}</td> <!-- Always 9:00 PM -->
                        <td>{{ $checkOutTime }}</td>
                        <td>{{ $status }}</td>
                        <td>{{ $checkOut->total_checkouts }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No employees found for check-out.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="container mt-3">
            <h5>Total Employee Check-Outs: {{ $totalEmployeeCheckOut }}</h5>
        </div>
        


        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $checkOutEmployees->appends(['search' => $search])->links() }}
        </div>
    </div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmCheckOut() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to check out this employee?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Check Out",
                    cancelButtonText: "No, Cancel",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to check-out page
                        window.location.href = "{{ route('check_out_employee_manual') }}";
                    }
                });
            }
        </script>
@stop
