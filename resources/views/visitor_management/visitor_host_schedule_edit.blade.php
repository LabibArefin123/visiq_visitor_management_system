@extends('adminlte::page')

@section('title', 'Edit Visitor Schedule')

@section('content')
<div class="container">
    <h2>Edit Schedule</h2>

    <form id="edit-form" action="{{ route('visitor_schedule.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Visitor ID Dropdown -->
        <div class="form-group">
            <label for="v_id">Visitor ID</label>
            <select name="v_id" id="v_id" class="form-control" required>
                @foreach ($visitors as $visitor)
                    <option value="{{ $visitor->id }}" 
                            {{ $schedule->visitor_id == $visitor->id ? 'selected' : '' }} 
                            data-name="{{ $visitor->name }}"
                            data-dob="{{ $visitor->date_of_birth }}"
                            data-age="{{ $visitor->age }}">
                        {{ $visitor->v_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Visitor Name (Auto-filled) -->
        <div class="form-group">
            <label for="visitor_name">Visitor Name</label>
            <input type="text" id="visitor_name" class="form-control" readonly>
        </div>

        <!-- Host/Employee Name -->
        <div class="form-group">
            <label for="employee_name">Host/Employee Name</label>
            <input type="text" name="employee_name" id="employee_name" class="form-control" value="{{ $schedule->employee_name }}" required>
        </div>

        <!-- Check-in Time -->
        <div class="form-group">
            <label for="check_in_time">Check-in Time</label>
            <input type="datetime-local" name="check_in_time" id="check_in_time" class="form-control" 
                   value="{{ \Carbon\Carbon::parse($schedule->check_in_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <!-- Check-out Time -->
        <div class="form-group">
            <label for="check_out_time">Check-out Time</label>
            <input type="datetime-local" name="check_out_time" id="check_out_time" class="form-control"
                   value="{{ $schedule->check_out_time ? \Carbon\Carbon::parse($schedule->check_out_time)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <!-- Date of Birth (Auto-filled) -->
        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="text" id="date_of_birth" class="form-control" readonly>
        </div>

        <!-- Age (Auto-filled) -->
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" id="age" class="form-control" readonly>
        </div>

        <button type="button" id="update-btn" class="btn btn-primary">Update Schedule</button>
    </form>
</div>

<script>
    function updateVisitorDetails() {
        var selectedOption = document.querySelector('#v_id option:checked');
        if (selectedOption) {
            document.getElementById('visitor_name').value = selectedOption.getAttribute('data-name');
            document.getElementById('date_of_birth').value = selectedOption.getAttribute('data-dob');
            document.getElementById('age').value = selectedOption.getAttribute('data-age');
        }
    }

    // Update visitor details when selection changes
    document.getElementById('v_id').addEventListener('change', updateVisitorDetails);

    // Auto-fill visitor details on page load
    window.onload = updateVisitorDetails;

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('update-btn').addEventListener('click', function(event) {
            Swal.fire({
                title: "Update Schedule?",
                text: "Are you sure you want to update this schedule?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Update",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('edit-form').submit();
                }
            });
        });
    });
</script>

@endsection
