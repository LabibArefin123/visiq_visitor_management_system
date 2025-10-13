@extends('adminlte::page')

@section('title', 'Manual Visitor Check-Out')

@section('content')
    <div class="container">
        <h2>Manual Visitor Check-Out</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form for manual visitor check-out -->
        <form method="POST" action="{{ route('store_checkout_manual') }}">
            @csrf
            <div class="mb-3">
                <label for="visitor_id" class="form-label">Select Visitor</label>
                <select class="form-control" id="visitor_id" name="visitor_id" required onchange="fetchVisitorDetails()">
                    <option value="" disabled selected>Choose a visitor</option>
                    @foreach ($visitors as $visitor)
                        <option value="{{ $visitor->id }}" data-dob="{{ $visitor->date_of_birth }}">
                            {{ $visitor->name }} ({{ $visitor->purpose }})
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">The name and purpose will be fetched automatically based on the visitor.</small>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" name="age" readonly>
            </div>

            <div class="mb-3">
                <label for="check_out_time" class="form-label">Check-Out Time</label>
                <input type="time" class="form-control" id="check_out_time" name="check_out_time" required>
                <small class="form-text text-muted">Ensure the check-out time is valid and logical.</small>
            </div>

            <button type="submit" class="btn btn-primary">Check Out</button>
            <a href="{{ route('visitor_check_out') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        function fetchVisitorDetails() {
            let visitorSelect = document.getElementById("visitor_id");
            let selectedOption = visitorSelect.options[visitorSelect.selectedIndex];
            let dob = selectedOption.getAttribute("data-dob");

            if (dob) {
                let birthDate = new Date(dob);
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                document.getElementById("age").value = age;
            } else {
                document.getElementById("age").value = "N/A";
            }
        }
    </script>
@stop

@section('js')
    <script>
        // Handle any additional front-end logic for form validation
        document.getElementById('check_out_time').addEventListener('change', function() {
            const selectedTime = new Date(`1970-01-01T${this.value}:00`);
            const now = new Date();
            if (selectedTime.getTime() > now.getTime()) {
                alert('Check-out time cannot be in the future.');
                this.value = '';
            }
        });

        console.log('Manual Visitor Check-Out Page Loaded');
    </script>
@stop
