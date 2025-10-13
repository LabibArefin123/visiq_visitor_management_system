@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h2>System Notifications</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add Notification Button -->
        <div class="mb-3 text-right">
            <a href="{{ route('notificationsAndAlerts.createSystemNotification') }}" class="btn btn-success"
                id="add-notification-btn">Add New Notification</a>
        </div>
        
        <!-- Notifications Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Target Audience</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $notification->title }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ ucfirst($notification->target_audience) }}</td>
                        <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('notificationsAndAlerts.deleteSystemNotification', $notification->id) }}"
                                method="POST" class="delete-notification-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-notification-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $notifications->links() }}
        </div>

        <!-- Total System Notifications -->
        <div class="alert alert-info text-center mt-3">
            <strong>Total System Notifications: {{ $totalSystemNotifications }}</strong>
        </div>

    </div>
@stop

@section('js')
    <script>
        document.getElementById('add-notification-btn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link action

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to create a new system notification.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Proceed',
                cancelButtonText: 'No, Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this
                        .href; // Redirect to the create notification page if confirmed
                } else {
                    Swal.fire('Cancelled', 'New notification was not created.', 'info');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Select all delete buttons
            document.querySelectorAll('.delete-notification-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent form submission

                    let form = this.closest('form'); // Get the closest form

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will permanently delete the notification.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form if confirmed
                        }
                    });
                });
            });
        });
    </script>
@stop
