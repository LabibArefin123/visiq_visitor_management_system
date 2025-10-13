@extends('adminlte::page')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit User</h1>

        <!-- Permissions Form Card -->
        <div class="row ">
            <div class="col">
                <div class="card">
                   
                    <div class="card-body">
                        <form action="{{route('users.update', $user->id)}}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control" 
                                    value="{{old('name', $user->name)}}"
                                    placeholder="Enter role name" 
                                    required
                                >
                                @error('name')
                                    <p class="text-red-400 font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="email" 
                                    class="form-control" 
                                    value="{{old('email', $user->email)}}"
                                    placeholder="Enter email" 
                                    required
                                >
                                @error('email')
                                    <p class="text-red-400 font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="row">
                                @if($roles->isNotEmpty())
                                    @foreach($roles as $role)
                                        <div class="col-md-3 col-sm-4 col-6 mb-2">
                                            <div class="form-check">
                                                {{--  --}}
                                                <input {{($hasRoles->contains($role->id)) ? 'checked' : ''}} type="checkbox" name="role[]" id="role - {{$role->id}}" value="{{ $role->name }}" class="form-check-input">
                                                <label class="form-check-label" for="role - {{$role->id}}">{{ $role->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
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
