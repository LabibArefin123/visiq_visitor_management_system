@extends('adminlte::page')

@section('title', 'Visitor Host Schedule')

@section('content')
    <div class="container mx-auto py-6">
        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-4">Visitor Host Schedule</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Here is the schedule of visitors with their respective hosts.</p>
        <div class="mb-3">
            <a href="{{ route('visitor_schedule.create') }}" class="btn btn-primary">Add Schedule</a>
            <a href="{{ route('visitor_schedule.group.index') }}" class="btn btn-secondary">Group Schedule</a>
            <!-- Group Schedule Button -->
        </div> <!-- Add Schedule Button -->
        <!-- Visitor Host Schedule Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vid</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Age</th>
                    <th>Host/Employee Name</th>
                    <th>Check-in Time</th>
                    <th>Check-out Time</th>
                  
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitorSchedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->visitor->v_id ?? 'N/A' }}</td>
                        <td>{{ $schedule->visitor ? $schedule->visitor->name : 'N/A' }}</td>

                        <td>
                            {{ $schedule->visitor ? ($schedule->visitor->date_of_birth ? \Carbon\Carbon::parse($schedule->visitor->date_of_birth)->format('Y-m-d') : 'N/A') : 'N/A' }}
                        </td>
                        <td>
                            {{ $schedule->visitor && $schedule->visitor->date_of_birth ? \Carbon\Carbon::parse($schedule->visitor->date_of_birth)->age : 'N/A' }}
                        </td>

                        <td>{{ $schedule->employee_name }}</td>
                        <td>
                            {{ $schedule->check_in_time ? \Carbon\Carbon::parse($schedule->check_in_time)->format('Y-m-d h:i A') : 'N/A' }}
                        </td>
                        <td>
                            {{ $schedule->check_out_time ? \Carbon\Carbon::parse($schedule->check_out_time)->format('Y-m-d h:i A') : 'N/A' }}
                        </td>
                        
                        <td>
                            <div class="d-flex justify-content-start">
                                <!-- View Button -->
                                <a href="{{ route('visitor_schedule.view', $schedule->id) }}"
                                    class="btn btn-info btn-sm mr-2 view-btn"
                                    data-url="{{ route('visitor_schedule.view', $schedule->id) }}">View</a>

                                <!-- Edit Button -->
                                <a href="{{ route('visitor_schedule.edit', $schedule->id) }}"
                                    class="btn btn-primary btn-sm mr-2 edit-btn"
                                    data-url="{{ route('visitor_schedule.edit', $schedule->id) }}">Edit</a>

                                <!-- Delete Button -->
                                <form class="delete-form" action="{{ route('visitor_schedule.delete', $schedule->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                        data-id="{{ $schedule->id }}">Delete</button>
                                </form>
                            </div>
                        </td>

                        @section('js')
                           
                            
                        @endsection

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add Schedule Alert
            document.querySelector('a[href="{{ route('visitor_schedule.create') }}"]').addEventListener('click',
                function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Do you want to add a new schedule?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = this.href;
                        }
                    });
                });

            // Group Schedule Alert
            document.querySelector('a[href="{{ route('visitor_schedule.group.index') }}"]').addEventListener(
                'click',
                function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Proceed to Group Schedule?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = this.href;
                        }
                    });
                });
        });
        document.addEventListener("DOMContentLoaded", function() {

            // View Button Alert
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    let url = this.getAttribute('data-url');
                    Swal.fire({
                        title: "Viewing Schedule",
                        text: "You are about to view the schedule details.",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonText: "Proceed",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });

            // Edit Button Alert
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    let url = this.getAttribute('data-url');
                    Swal.fire({
                        title: "Edit Schedule",
                        text: "Are you sure you want to edit this schedule?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, Edit",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });

            // Delete Button Alert
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    let form = this.closest('.delete-form');
                    Swal.fire({
                        title: "Delete Schedule?",
                        text: "This action cannot be undone.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Yes, Delete",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

        });
    </script>
@endsection
