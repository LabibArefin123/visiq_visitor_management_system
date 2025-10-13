@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content')
<div class="container">
    <h2>Add Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="E_id" class="form-label">Employee ID</label>
            <input type="text" class="form-control" id="E_id" name="E_id" value="{{ old('E_id') }}" required>
        </div>
    
        <div class="mb-3">
            <label for="profile_photo" class="form-label">Profile Photo</label>
            <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*" required>
        </div>
    
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="national_id" class="form-label">National ID</label>
            <input type="text" class="form-control" id="national_id" name="national_id" value="{{ old('national_id') }}">
        </div>
       
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" required onchange="calculateAge()">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="text" class="form-control" id="age" name="age" value="{{ old('age') }}" readonly>
        </div>
    
        <button type="submit" class="btn btn-primary">Add Employee</button>
        <a href="{{ route('employee_management') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@stop

@section('footer')
    <div style="position: fixed; bottom: 5px; right: 5px; text-align: middle;">
        <p class="text-muted medium">
            Design and Developed by
            <a href="https://www.totalofftec.com" target="_blank" style="color: #007bff;">TOTALOFFTEC</a>
        </p>
    </div>
@endsection

@section('js')
<script>
    function calculateAge() {
        var dob = document.getElementById('dob').value;
        if (dob) {
            var dobDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - dobDate.getFullYear();
            var m = today.getMonth() - dobDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        }
    }
</script>
@endsection