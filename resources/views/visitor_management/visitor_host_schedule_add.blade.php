@extends('adminlte::page')

@section('title', 'Add Visitor Schedule')

@section('content')
    <div class="container">
        <h1>Add Visitor Schedule</h1>

        <form action="{{ route('visitor_schedule.store') }}" method="POST">
            @csrf

            <!-- Visitor ID Dropdown -->
            <div class="form-group">
                <label for="v_id">Visitor ID</label>
                <select name="v_id" id="v_id" class="form-control" required>
                    @foreach ($visitors as $visitor)
                        <option value="{{ $visitor->id }}" 
                                data-name="{{ $visitor->name }}" 
                                data-dob="{{ $visitor->date_of_birth }}" 
                                data-age="{{ $visitor->age }}">
                            {{ $visitor->v_id }}
                        </option>
                    @endforeach
                </select>
                
            </div>

            <!-- Visitor Name (Auto-fills on Visitor ID selection) -->
            <div class="form-group">
                <label for="visitor_name">Visitor Name</label>
                <input type="text" id="visitor_name" class="form-control" readonly>
            </div>

            <!-- Host/Employee Name -->
            <div class="mb-3">
                <label class="form-label">Host/Employee Name:</label>
                <select name="employee_name" class="form-control" required>
                    <option value="">Select an Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Check-in Time -->
            <div class="form-group">
                <label for="check_in_time">Check-in Time</label>
                <input type="datetime-local" name="check_in_time" id="check_in_time" class="form-control" required>
            </div>

            <!-- Check-out Time -->
            <div class="form-group">
                <label for="check_out_time">Check-out Time</label>
                <input type="datetime-local" name="check_out_time" id="check_out_time" class="form-control">
            </div>

            <!-- Date of Birth (Auto-fills on Visitor ID selection) -->
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="text" id="date_of_birth" class="form-control" readonly>
            </div>

            <!-- Age (Auto-fills on Visitor ID selection) -->
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" id="age" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('v_id').addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    document.getElementById('visitor_name').value = selectedOption.dataset.name || '';
                    document.getElementById('date_of_birth').value = selectedOption.dataset.dob || '';
                    document.getElementById('age').value = selectedOption.dataset.age || '';
                });

                // Auto-fill on page load
                document.getElementById('v_id').dispatchEvent(new Event('change'));
            });
        </script>
    </div>
@endsection
