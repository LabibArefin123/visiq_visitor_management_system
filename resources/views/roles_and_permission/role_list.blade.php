@extends('adminlte::page')

@section('title', 'Roles | Dashboard')

@section('content_header')
    <h1>Role List</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div id="errorBox"></div>
        <div class="card">
            <div class="card-header">
                {{-- <div class="card-title">
                   <h5>List</h5>
               </div> --}}
                <a href="{{ route('role_permission.create') }}" class="float-right btn btn-primary btn-xs m-0 add-new-btn">
                    <i class="fas fa-plus"></i> Add New
                </a>


                {{-- <a class="float-right btn btn-primary btn-xs m-0" href="{{route('users.roles.create')}}"><i class="fas fa-plus"></i> Add New</a> --}}
            </div>
            <div class="card-body">
                <!--DataTable-->
                <div class="table-responsive">
                    <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>ID</th>

                                <th>Users</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @switch($role->user_type)
                                            @case(1)
                                                Admin
                                            @break

                                            @case(2)
                                                DD Admin
                                            @break

                                            @case(3)
                                                AD Admin
                                            @break

                                            @case(4)
                                                D Admin
                                            @break

                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                    <td>
                                        {{ $role->route_count }} route{{ $role->route_count > 1 ? 's' : '' }}
                                        <br>

                                        @if (!empty($role->routes))
                                            <div class="mt-2">
                                                @php
                                                    $categorizedRoutes = [
                                                        'Visitor Management' => [],
                                                        'Employee Management' => [],
                                                        'User Management' => [],
                                                        'Reports' => [],
                                                        'Roles & Permissions' => [],
                                                        'Other' => [],
                                                    ];

                                                    foreach ($role->routes as $route) {
                                                        if (str_starts_with($route, 'visitor')) {
                                                            $categorizedRoutes['Visitor Management'][] = $route;
                                                        } elseif (str_starts_with($route, 'employee')) {
                                                            $categorizedRoutes['Employee Management'][] = $route;
                                                        } elseif (str_starts_with($route, 'user')) {
                                                            $categorizedRoutes['User Management'][] = $route;
                                                        } elseif (str_starts_with($route, 'report')) {
                                                            $categorizedRoutes['Reports'][] = $route;
                                                        } elseif (
                                                            str_starts_with($route, 'role') ||
                                                            str_starts_with($route, 'permission')
                                                        ) {
                                                            $categorizedRoutes['Roles & Permissions'][] = $route;
                                                        } else {
                                                            $categorizedRoutes['Other'][] = $route;
                                                        }
                                                    }
                                                @endphp

                                                @foreach ($categorizedRoutes as $section => $routes)
                                                    @if (count($routes) > 0)
                                                        <strong class="d-block text-primary">{{ $section }}</strong>
                                                        @foreach ($routes as $route)
                                                            <span class="badge badge-secondary">{{ $route }}</span>
                                                        @endforeach
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        {{-- Edit Button with SweetAlert --}}
                                        <a href="{{ route('role_permission.edit', $role->id) }}"
                                            class="btn btn-sm btn-warning edit-role-btn" data-role="{{ $role->user_type }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete Button with SweetAlert Confirm --}}
                                        <form action="{{ route('role_permission.delete', $role->id) }}" method="POST"
                                            class="d-inline delete-role-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.add-new-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to create a new role and assign permissions?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, go ahead',
                    cancelButtonText: 'No, stay here',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });

        // Delete confirmation alert
        document.querySelectorAll('.delete-role-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This role will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Edit alert on click
        document.querySelectorAll('.edit-role-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'Redirecting to Edit',
                    text: 'You are being redirected to edit this role.',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000,
                    willClose: () => {
                        window.location.href = href;
                    }
                });
            });
        });

        // Show flash messages using SweetAlert
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection
