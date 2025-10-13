@extends('adminlte::page')

@section('title', 'Pending Visitor Add')

@section('content')
<div class="container">
    <h2>Add Pending Visitor</h2>
    <form action="{{ route('visitor.pending_visitor.store') }}" method="POST" id="pendingVisitorForm">
        @csrf

        <div class="form-group">
            <label for="v_id">Visitor ID</label>
            <input type="text" name="v_id" id="v_id" class="form-control" value="{{ old('v_id') }}" required>
            @error('v_id') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
            @error('phone') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <input type="text" name="purpose" id="purpose" class="form-control" value="{{ old('purpose') }}" required>
            @error('purpose') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="visit_date">Visit Date</label>
            <input type="date" name="visit_date" id="visit_date" class="form-control" value="{{ old('visit_date') }}" required>
            @error('visit_date') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
            @error('date_of_birth') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="national_id">National ID</label>
            <input type="text" name="national_id" id="national_id" class="form-control" value="{{ old('national_id') }}">
            @error('national_id') 
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" name="age" id="age" class="form-control" value="{{ old('age') }}" readonly>
        </div>

        <button type="submit" class="btn btn-success">Add Visitor</button>
        <a href="{{ route('visitor.pending_visitor_management') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection


@section('js')
<script>
    // Calculate age based on date of birth
    document.getElementById('date_of_birth').addEventListener('change', function() {
        var dob = new Date(this.value);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var m = today.getMonth() - dob.getMonth();
        
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        document.getElementById('age').value = age;
    });
</script>
@endsection

@section('js')
<style>
    /* Custom fade-in animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Styling for SweetAlert */
    .swal2-popup {
        animation: fadeIn 0.3s ease-in-out !important;
        border-radius: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('pendingVisitorForm');

        // Load stored form data if available
        if (localStorage.getItem('pendingVisitorForm')) {
            const savedData = JSON.parse(localStorage.getItem('pendingVisitorForm'));
            for (const key in savedData) {
                if (form[key]) form[key].value = savedData[key];
            }
        }

        // Save data on input change
        form.addEventListener('input', function () {
            const formData = {};
            new FormData(form).forEach((value, key) => {
                formData[key] = value;
            });
            localStorage.setItem('pendingVisitorForm', JSON.stringify(formData));
        });

        // Remove stored data on successful form submission
        form.addEventListener('submit', function () {
            localStorage.removeItem('pendingVisitorForm');
        });

        // Confirmation before leaving the page
        window.addEventListener('beforeunload', function (event) {
            event.preventDefault();
            event.returnValue = '';
        });

        // Show a friendly alert if the user tries to leave
        window.addEventListener('popstate', function () {
            Swal.fire({
                title: 'Oops! Are you sure?',
                text: 'You have unsaved changes. Do you really want to leave?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Leave!',
                cancelButtonText: 'Stay Here',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        });

        // Disable right-click and show animated alert
        document.addEventListener("contextmenu", function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Oops! Right-click is disabled!',
                text: 'For security reasons, right-click navigation is not allowed.',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500,
                customClass: {
                    popup: 'swal2-popup'
                }
            });
        });
    });
</script>
@endsection
