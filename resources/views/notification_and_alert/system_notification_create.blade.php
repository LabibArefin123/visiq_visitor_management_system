@extends('adminlte::page')

@section('title', 'Add Notification')

@section('content')
    <div class="container">
        <h2>Add New Notification</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('notificationsAndAlerts.storeSystemNotification') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required>{{ old('message') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="target_audience" class="form-label">Target Audience</label>
                <select class="form-control" id="target_audience" name="target_audience" required>
                    <option value="all">All</option>
                    <option value="employees">Employees</option>
                    <option value="admins">Admins</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="submit-notification-btn">Submit</button>
            <a href="{{ route('system_notification') }}" class="btn btn-secondary" id="cancel-notification-btn">Cancel</a>
        </form>
    </div>
@stop
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Submit button confirmation
        document.getElementById('submit-notification-btn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to submit this notification?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Submit',
                cancelButtonText: 'No, Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit(); // Submit the form if confirmed
                }
            });
        });

        // Cancel button confirmation
        document.getElementById('cancel-notification-btn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default navigation

            Swal.fire({
                title: 'Are you sure?',
                text: "Unsaved changes will be lost.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Go Back',
                cancelButtonText: 'No, Stay Here'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.href; // Redirect to system_notification route
                }
            });
        });
    });
</script>
@stop