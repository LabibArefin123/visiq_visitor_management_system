@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content')
<div class="container">
    <h2>Edit Employee</h2>

    <div class="card mt-3">
        <div class="card-body">
            <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Picture -->
                <div class="mb-3 text-center">
                    <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : asset('images/default.jpg') }}" 
                         class="rounded-circle" width="100" height="100">
                    <input type="file" name="profile_picture" class="form-control mt-2">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $employee->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="national_id" class="form-label">National ID</label>
                    <input type="text" name="national_id" id="national_id" class="form-control" value="{{ $employee->national_id }}" required>
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="{{ $employee->dob }}" required>
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" name="department" id="department" class="form-control" value="{{ $employee->department }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $employee->phone }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $employee->email }}" required>
                </div>

                <button type="submit" class="btn btn-success">Save Changes</button>
                <a href="{{ route('employee_management') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection