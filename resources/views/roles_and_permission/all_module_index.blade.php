@extends('adminlte::page')

@section('title', 'All Modules')

@section('content')
    <div class="container">
        <h1>All Modules</h1>

        <!-- Button to Create New Module -->
        <a href="{{ route('modules.create') }}" class="btn btn-success mb-3">Create Module</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Module Name</th>
                    <th>Description</th>
                    <th>Controller</th>
                    <th>Routes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $module)
                    <tr>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->description }}</td>
                        <td>{{ $module->controller_name }}</td>
                        <td>
                            @if ($module->routes && is_string($module->routes))
                                @php
                                    // Decode routes if it's a JSON string
                                    $routes = json_decode($module->routes, true);
                                @endphp

                                @if (is_array($routes))
                                    @foreach ($routes as $route)
                                        <p><a href="{{ route($route) }}" target="_blank">{{ $route }}</a></p>
                                    @endforeach
                                @else
                                    <p>No routes available</p>
                                @endif
                            @else
                                <p>No routes available</p>
                            @endif

                        </td>
                        <td>
                            <!-- Edit button -->
                            <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-primary">Edit</a>

                            <!-- Show button -->
                            <a href="{{ route('modules.show', $module->id) }}" class="btn btn-info">Show</a>

                            <!-- Delete button -->
                            <form action="{{ route('modules.delete', $module->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this module?')">Delete</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
