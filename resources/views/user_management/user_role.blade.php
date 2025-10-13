@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>User Roles</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Role Form -->
    <div class="mb-3">
        <form action="{{ route('store_role') }}" method="POST" class="form-inline">
            @csrf
            <div class="form-group mr-2">
                <label for="name" class="mr-2">Role Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter role name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Add New Role</button>
        </form>
    </div>

    <!-- Show All Routes Button -->
    <div class="mb-3">
        <a href="{{ route('permissions.index') }}" class="btn btn-primary">Show All Permissions</a>
    </div>

    <!-- Roles Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @if($role->permissions->count() > 0)
                            {{ $role->permissions->pluck('name')->join(', ') }}
                        @else
                            <em>No permissions assigned</em>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('delete_role', $role->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
@stop
