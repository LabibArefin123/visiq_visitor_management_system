@extends('adminlte::page')

@section('title', 'Edit Permissions')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Roles</h1>

        <!-- Permissions Form Card -->
        <div class="row ">
            <div class="col">
                <div class="card">
                   
                    <div class="card-body">
                        <form action="{{route('role.update', $role->id)}}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control" 
                                    value="{{old('name', $role->name)}}"
                                    placeholder="Enter role name" 
                                    required
                                >
                                @error('name')
                                    <p class="text-red-400 font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="row">
                                @if($permissions->isNotEmpty())
                                    @foreach($permissions as $permission)
                                        <div class="col-md-3 col-sm-4 col-6 mb-2">
                                            <div class="form-check">
                                                <input {{($hasPermissions->contains($permission->name)) ? 'checked' : ''}} type="checkbox" name="permission[]" id="permission - {{$permission->id}}" value="{{ $permission->name }}" class="form-check-input">
                                                <label class="form-check-label" for="permission - {{$permission->id}}">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <a href="{{ route('role.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                 Update Role
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
