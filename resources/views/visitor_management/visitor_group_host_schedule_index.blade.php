@extends('adminlte::page')

@section('title', 'Group Visitor Schedules')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Group Visitor Host Schedules</h1>

        <div class="mb-3 d-flex justify-content-between">
            <h4>Visitor Group Schedule List</h4>
            <div>
                <a href="{{ route('visitor_schedule.group.create') }}" class="btn btn-primary mb-3">Add Group Schedule</a>
                <a href="{{ route('visitor_schedule.index') }}" class="btn btn-secondary mb-3">Visitor Schedule</a>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Host Name</th>
                    <th>Check-in Time</th>
                    <th>Check-out Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupSchedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->company_name }}</td>
                        <td>{{ $schedule->employee_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->check_in_time)->format('Y-m-d h:i A') }}</td>
                        <td>{{ $schedule->check_out_time ? \Carbon\Carbon::parse($schedule->check_out_time)->format('Y-m-d h:i A') : 'N/A' }}
                        </td>
                        <td>
                            <a href="{{ route('visitor_schedule.group.edit', $schedule->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>

                            <!-- DELETE BUTTON WITH SWEETALERT -->
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $schedule->id }}">Delete</button>

                            <!-- Hidden Delete Form -->
                            <form id="delete-form-{{ $schedule->id }}"
                                action="{{ route('visitor_schedule.group.delete', $schedule->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add Group Schedule Alert
            document.querySelector('.btn-primary.mb-3').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Proceed to Add Group Schedule?",
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

            // Visitor Schedule Alert
            document.querySelector('.btn-secondary.mb-3').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Go to Visitor Schedule?",
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

            // Edit Button Alert
            document.querySelectorAll('.btn-primary.btn-sm').forEach((button) => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Do you want to edit this schedule?",
                        icon: "warning",
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
        });
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    let scheduleId = this.getAttribute("data-id");
                    Swal.fire({
                        title: "Are you sure?",
                        text: "This action cannot be undone!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${scheduleId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
