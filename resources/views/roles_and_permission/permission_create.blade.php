@extends('adminlte::page')

@section('title', 'Create Permissions')

@section('content')
    <div class="container">
        <h1 class="mb-4">All Permissions</h1>

        <!-- Permissions Form Card -->
        <div class="row ">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Permission</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route ('permission.store')}}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control" 
                                    value="{{old('name')}}"
                                    placeholder="Enter permission name" 
                                    required
                                >
                                @error('name')
                                    <p class="text-red-400 font-medium">{{$message}}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create Permission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
