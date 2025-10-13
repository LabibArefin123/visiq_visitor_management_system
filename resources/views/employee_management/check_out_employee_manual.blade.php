@extends('adminlte::page')

@section('title', 'Manual Employee Check-Out')

@section('content')
    <div class="container">
        <h2>Manual Employee Check-Out</h2>

        <!-- Display success message if any -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for manual employee check-out -->
        <form method="POST" action="{{ route('checkout_employee_store') }}" id="checkout-form">
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
                <label for="check_out_time" class="form-label">Check-Out Time</label>
                <input type="time" class="form-control" id="check_out_time" name="check_out_time" required>
                <small class="form-text text-muted">Check-out time should not be before 8:00 PM.</small>
            </div>

            <button type="submit" class="btn btn-primary" id="submit-btn">Check Out</button>
            <a href="{{ route('check_out_employee') }}" class="btn btn-secondary" id="cancel-btn">Cancel</a>
        </form>

    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        // Validate the check-out time in the front-end to ensure it is not before 8 PM
        document.getElementById('check_out_time').addEventListener('change', function() {
            const time = this.value.split(':');
            const hour = parseInt(time[0], 10);
            if (hour < 20) {
                alert('Check-out time cannot be before 8:00 PM.');
                this.value = '';
            } else if (hour > 23) {
                alert('Late Checkout! Check-out time exceeds the allowed time.');
            }
        });
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to check out this employee.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Check Out!',
                    cancelButtonText: 'No, Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Submit the form if confirmed
                        Swal.fire('Checked Out!', 'The employee has been checked out.', 'success');
                    } else {
                        Swal.fire('Cancelled', 'The check-out process has been cancelled.', 'info');
                    }
                });
            });

            // SweetAlert on Cancel button
            document.getElementById('cancel-btn').addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link action

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to cancel the check-out process.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Cancel',
                    cancelButtonText: 'No, Go Back'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = this.href; // Redirect to the cancel link if confirmed
                    }
                });
            });
    </script>
@stop
