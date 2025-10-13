@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h2>Add New User</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- <form action="{{ route('userManagement.storeUser') }}" method="POST"> --}}
        <form action="{{ route('store_user') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number (Optional)</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <div class="form-group">
                <label for="role">Assign Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Select Role</option>
                    @foreach (App\Models\Role::all() as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
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