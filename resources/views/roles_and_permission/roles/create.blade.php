@extends('adminlte::page')

@section('title', 'Add Role')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add Roles</h1>
        <button class="btn btn-sm btn-warning d-flex align-items-center gap-1" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z" />
            </svg>
            Go Back
        </button>
    </div>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf

        <div class="form-group">
            <label for="role">Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <h4 class="mt-4">Assign Permissions (Grouped by Controller)</h4>

        @foreach ($routes as $controller => $controllerRoutes)
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h5 class="text-primary mb-0">{{ $controller }}</h5>
                <button type="button" class="btn btn-sm btn-outline-primary select-all-btn"
                    data-controller="{{ \Illuminate\Support\Str::slug($controller) }}">
                    Select All
                </button>
            </div>

            <table class="table table-bordered mb-4" id="table-{{ \Illuminate\Support\Str::slug($controller) }}">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Permission Name (Route Name)</th>
                        <th>URI</th>
                        <th>Guard</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($controllerRoutes as $route)
                        <tr>
                            <td>
                                <input type="checkbox" name="permissions[]" value="{{ $route->getName() }}"
                                    id="perm_{{ $route->getName() }}"
                                    class="perm-checkbox-{{ \Illuminate\Support\Str::slug($controller) }}">
                            </td>
                            <td>
                                <label for="perm_{{ $route->getName() }}">{{ $route->getName() }}</label>
                            </td>
                            <td>{{ $route->uri() }}</td>
                            <td>web</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.select-all-btn');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const controllerSlug = this.getAttribute('data-controller');
                    const checkboxes = document.querySelectorAll('.perm-checkbox-' +
                        controllerSlug);
                    checkboxes.forEach(cb => cb.checked = true);
                });
            });
        });
    </script>
@endsection
