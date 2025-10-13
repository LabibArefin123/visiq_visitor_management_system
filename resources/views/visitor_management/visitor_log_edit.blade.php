@extends('adminlte::page')

@section('title', 'Edit Visitor')

@section('content')
    <div class="container">
        <h2>Edit Visitor</h2>

        <form action="{{ route('visitor.update', $visitor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="v_id">Visitor ID</label>
                <input type="text" name="v_id" id="v_id" class="form-control"
                    value="{{ old('v_id', $visitor->v_id) }}" placeholder="Enter Visitor ID">
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $visitor->name) }}" placeholder="Enter visitor's name" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone', $visitor->phone) }}" placeholder="Enter phone number" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $visitor->email) }}" placeholder="Enter email address">
            </div>

            <div class="form-group">
                <label for="purpose">Visit Purpose</label>
                <input type="text" name="purpose" id="purpose" class="form-control"
                    value="{{ old('purpose', $visitor->purpose) }}" placeholder="Enter visit purpose" required>
            </div>

            <div class="form-group">
                <label for="visit_date">Visit Date</label>
                <input type="date" name="visit_date" id="visit_date" class="form-control"
                    value="{{ old('visit_date', $visitor->visit_date ? \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d') : '') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                    value="{{ old('date_of_birth', $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : '') }}">
            </div>

            <div class="form-group">
                <label for="national_id">National ID</label>
                <input type="text" name="national_id" id="national_id" class="form-control"
                    value="{{ old('national_id', $visitor->national_id) }}" placeholder="Enter National ID number">
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $visitor->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $visitor->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $visitor->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('visitor_management') }}" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        console.log('Edit Visitor Page');
    </script>
@stop
