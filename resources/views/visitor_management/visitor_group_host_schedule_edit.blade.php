@extends('adminlte::page')

@section('title', 'Edit Group Visitor Schedule')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Edit Group Visitor Host Schedule</h1>

        <form action="{{ route('visitor_schedule.group.update', $groupSchedule->id) }}" method="POST" id="update-schedule-form">
            @csrf

            <div class="mb-3">
                <label class="form-label">Company Name:</label>
                <select name="company_name" class="form-control" required>
                    @foreach($companies as $company)
                        <option value="{{ $company->company_name }}" 
                            {{ $groupSchedule->company_name == $company->company_name ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Host/Employee Name:</label>
                <select name="employee_name" class="form-control" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->name }}" 
                            {{ $groupSchedule->employee_name == $employee->name ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-in Time:</label>
                <input type="datetime-local" name="check_in_time" class="form-control" value="{{ $groupSchedule->check_in_time }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out Time (Optional):</label>
                <input type="datetime-local" name="check_out_time" class="form-control" value="{{ $groupSchedule->check_out_time }}">
            </div>

            <button type="submit" class="btn btn-primary" id="update-schedule-btn">Update Schedule</button>

            <!-- Cancel Button with SweetAlert -->
            <a href="{{ route('visitor_schedule.group.index') }}" class="btn btn-secondary" id="cancel-btn">Cancel</a>
        </form>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert for Update Schedule Button
    document.getElementById("update-schedule-btn").addEventListener("click", function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure you want to update the schedule?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("update-schedule-form").submit(); // Submit the form
            }
        });
    });

    // SweetAlert for Cancel Button
    document.getElementById("cancel-btn").addEventListener("click", function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure you want to cancel?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, cancel",
            cancelButtonText: "No, go back",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = this.href; // Redirect to the cancel route
            }
        });
    });
</script>
@endsection
