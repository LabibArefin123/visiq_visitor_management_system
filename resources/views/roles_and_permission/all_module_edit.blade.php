@extends('adminlte::page')

@section('title', 'Edit Module')

@section('content')
    <div class="container">
        <h1>Edit Module: {{ $module->name }}</h1>

        <!-- Check for success message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="{{ route('modules.update', $module->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Module Name</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name', $module->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" required>{{ old('description', $module->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="controller_name">Controller Name</label>
                <input type="text" class="form-control" name="controller_name" id="controller_name"
                    value="{{ old('controller_name', $module->controller_name) }}" required>
            </div>

            <div class="form-group">
                <label for="routes">Routes (comma-separated)</label>
                <input type="text" class="form-control" name="routes" id="routes"
                    value="{{ old('routes', $module->routes) }}" required>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-success">Update Module</button>
                <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back to All Modules</a>
            </div>
        </form>

    </div>
@endsection
