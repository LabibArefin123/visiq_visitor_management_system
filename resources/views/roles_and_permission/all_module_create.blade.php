@extends('adminlte::page')

@section('title', 'Create Module')

@section('content')
    <div class="container">
        <h1>Create New Module</h1>

        <form action="{{ route('modules.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Module Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="controller_name">Controller Name</label>
                <select name="controller_name" id="controller_name" class="form-control" required>
                    <option value="">Select Controller</option>
                    @foreach ($controllers as $controller => $routes)
                        <option value="{{ $controller }}">{{ $controller }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="routes">Routes</label>
                <select name="routes[]" id="routes" class="form-control" multiple required>
                    <!-- Routes will be populated based on the selected controller -->
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Create Module</button>
        </form>
    </div>

    <script>
        // JavaScript to populate routes based on the selected controller
        document.getElementById('controller_name').addEventListener('change', function() {
            let controller = this.value;
            let routes = @json($controllers);

            let routeSelect = document.getElementById('routes');
            routeSelect.innerHTML = ''; // Clear existing options

            if (controller && routes[controller]) {
                routes[controller].forEach(function(route) {
                    let option = document.createElement('option');
                    option.value = route;
                    option.text = route;
                    routeSelect.appendChild(option);
                });
            }
        });
    </script>
@endsection
