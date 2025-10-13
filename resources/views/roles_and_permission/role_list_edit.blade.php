@extends('adminlte::page')

@section('title', 'Edit Role Permissions')

@section('content_header')
    <h1>Edit Role Permissions</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('role_permission.update', $role->id) }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-header">
                    <label for="user_type">Select Role</label>
                    <select class="form-control" name="user_type" required>
                        <option value="">-- Select --</option>
                        <option value="1" {{ $role->user_type == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $role->user_type == 2 ? 'selected' : '' }}>DD Admin</option>
                        <option value="3" {{ $role->user_type == 3 ? 'selected' : '' }}>AD Admin</option>
                        <option value="4" {{ $role->user_type == 4 ? 'selected' : '' }}>D Admin</option>
                    </select>
                </div>

                <div class="card-body">
                    <h5 class="d-flex justify-content-between align-items-center">
                        Assign Routes
                    </h5>

                    @foreach ($groupedRoutes as $section => $routes)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-primary mb-2">{{ $section }}</h6>
                                <div>
                                    <input type="checkbox" class="form-check-input select-all"
                                        data-section="{{ Str::slug($section) }}"
                                        id="select_all_{{ Str::slug($section) }}">
                                    <label class="form-check-label" for="select_all_{{ Str::slug($section) }}">
                                        Select All
                                    </label>
                                </div>
                            </div>

                            <div class="row section-group" data-section="{{ Str::slug($section) }}">
                                @foreach ($routes as $route)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input route-checkbox {{ Str::slug($section) }}"
                                                type="checkbox"
                                                name="routes[]"
                                                value="{{ $route->getName() }}"
                                                id="route_{{ md5($route->getName()) }}"
                                                {{ in_array($route->getName(), $role->routes ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="route_{{ md5($route->getName()) }}">
                                                {{ $route->getName() }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <button class="btn btn-success">Update Permissions</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js')
<script>
    // Same select all script from create form
    document.querySelectorAll('.select-all').forEach(function(selectAll) {
        selectAll.addEventListener('change', function() {
            const section = this.dataset.section;
            document.querySelectorAll('.' + section).forEach(function(checkbox) {
                checkbox.checked = selectAll.checked;
            });
        });
    });
</script>
@stop
