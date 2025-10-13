@extends('adminlte::page')

@section('title', 'Manual Employee Check-In')

@section('content')
    <div class="container">
        <h2>Manual Employee Check-In</h2>

        <!-- Display success message -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                });
            </script>
        @endif

        <!-- Display validation errors -->
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#d33',
                });
            </script>
        @endif

        <!-- Form for manual check-in -->
        <form id="checkinForm" method="POST" action="{{ route('checkin_employee_store') }}">
            @csrf
            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select name="employee_id" id="employee_id" class="form-control" required>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->department }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="check_in_time" class="form-label">Check-In Time</label>
                <input type="time" class="form-control" id="check_in_time" name="check_in_time" required>
                <small class="form-text text-muted">Check-in time should not be before 8:00 AM.</small>
            </div>

            <button type="button" id="confirmCheckIn" class="btn btn-primary">Check In</button>
            <button type="button" id="cancelCheckIn" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('check_in_time').addEventListener('change', function() {
            const time = this.value.split(':');
            const hour = parseInt(time[0], 10);
            if (hour < 8) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Time',
                    text: 'Check-in time cannot be before 8:00 AM.',
                });
                this.value = '';
            }
        });

        // Confirm Check-In
        document.getElementById('confirmCheckIn').addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to check in this employee.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Check In'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('checkinForm').submit();
                }
            });
        });

        // Confirm Cancel Action
        document.getElementById('cancelCheckIn').addEventListener('click', function() {
            Swal.fire({
                title: 'Cancel Check-In?',
                text: "Are you sure you want to cancel?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('check_in_employee') }}";
                }
            });
        });
    </script>
@stop
