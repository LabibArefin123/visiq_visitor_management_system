@extends('adminlte::page')

@section('title', 'All Permissions')

@section('content')
    <div class="container">
        <h1 class="mb-4">All Permissions</h1>

        <!-- Permissions List -->
        <div class="card">
            <div class="card-header">
                <h3>Existing Permissions</h3>
            </div>
            <div class="card-body">
                @foreach ($groupedRoutes as $controller => $routes)
                    <div class="mb-4 p-3 border rounded shadow-sm">
                        <h4 class="text-primary">{{ class_basename($controller) }} Controller</h4>
                        <p><strong>Class:</strong> {{ $controller }}</p>
        
                        <h5 class="mt-3">Routes:</h5>
                        <ul class="list-group">
                            @foreach ($routes as $route)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        <strong>{{ $route['title'] }}</strong> ({{ $route['name'] }})
                                    </span>
                                    <div>
                                        <a href="{{ route('permissions.showCode', $route['name']) }}" class="btn btn-info btn-sm" title="Show Code">
                                            <i class="fas fa-code"></i> Show Code
                                        </a>    

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
@endsection
