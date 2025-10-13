@extends('adminlte::page')

@section('title', 'Create Roles')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create Roles</h1>

        <!-- Permissions Form Card -->
        <div class="row">
            <div class="col">
                <div class="card">
                    
                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Enter Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control" 
                                    value="{{ old('name') }}"
                                    placeholder="Enter permission name" 
                                    required
                                >
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Grid Layout for Permissions -->
                            <div class="row">
                                @if($permissions->isNotEmpty())
                                    @foreach($permissions as $permission)
                                        <div class="col-md-3 col-sm-4 col-6 mb-2">
                                            <div class="form-check">
                                                <input type="checkbox" name="permission[]" id="permission - {{$permission->id}}" value="{{ $permission->name }}" class="form-check-input">
                                                <label class="form-check-label" for="permission - {{$permission->id}}">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Create Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
