@extends('adminlte::page')

@section('title', 'Roles and Permissions')

@section('content')
    <div class="container">
        <h2>Roles and Permissions Management</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Manage Roles</div>
            <div class="card-body">
                <h4>Create New Role</h4>
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="role_name">Role Name</label>
                        <input type="text" class="form-control" id="role_name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create Role</button>
                </form>


                <h4 class="mt-4">Existing Roles</h4>
                <ul class="list-group">
                    @forelse($roles as $role)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $role->name }}
                            <form action="{{ route('roles.remove') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="role" value="{{ $role->name }}">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item">No roles available.</li>
                    @endforelse
                </ul>
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header">Manage Permissions</div>
            <div class="card-body">
                <h4>Create New Permission</h4>
                <form method="POST" action="{{ route('permissions.storePermission') }}">
                    @csrf
                    <div class="form-group">
                        <label for="permission_name">Permission Name</label>
                        <input type="text" class="form-control" id="permission_name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create Permission</button>
                </form>

                <h4 class="mt-4">Existing Permissions</h4>
                <ul class="list-group">
                    @forelse($permissions as $permission)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $permission->name }}
                            <form action="{{ route('permissions.removePermission') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="permission" value="{{ $permission->name }}">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item">No permissions available.</li>
                    @endforelse
                </ul>
                
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header">Assign Roles and Permissions</div>
            <div class="card-body">
        
                <!-- Assign Role to Employee -->
                <h4>Assign Role to Employee</h4>
                <form method="POST" action="{{ route('roles.permissions.assignRole') }}">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Employee</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Assign Role</button>
                </form>
        
                <!-- Assign Permissions to Role -->
                <h4 class="mt-4">Assign Permissions to Role</h4>
                <form method="POST" action="{{ route('roles.permissions.assignPermission') }}">
                    @csrf
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select class="form-control" id="role_id" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <select class="form-control" id="permissions" name="permissions[]" multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Assign Permissions</button>
                </form>
            </div>
        </div>
        
        
    </div>
@stop
