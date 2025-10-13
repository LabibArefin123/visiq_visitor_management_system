@extends('adminlte::page')

@section('title', 'User List')

@section('content_header')
    <h1 class="mb-4">User List</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Users</h3>
            <div class="card-tools">
                <a href="#" class="btn btn-success btn-sm" id="addPermissionBtn">
                    <i class="fas fa-plus"></i> Add Roles
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead class="bg-light">
                    <tr>
                        <th width="60">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="180">Created</th>
                        <th class="text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->isNotEmpty())
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->roles->pluck('name')->implode(', ')}}</td>

                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</td>
                                <td class="text-center">
                                    <a href="{{route('users.edit', $user->id)}}"
                                        class="btn btn-primary btn-sm editPermissionBtn">
                                        Edit
                                    </a>
                                    {{-- <form action="{{route('role.destroy', $role->id),}}" method="POST"
                                        class="d-inline deleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm deletePermissionBtn">
                                            Delete
                                        </button>
                                    </form>  --}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No roles found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert for Add Permission Button
        document.getElementById('addPermissionBtn').addEventListener('click', function(event) {
            event.preventDefault();
            let url = this.getAttribute('href'); // Get the redirection URL

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to add a new roles?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; // Redirect if confirmed
                }
            });
        });

        // SweetAlert for Edit Permission Button
        document.querySelectorAll('.editPermissionBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let url = this.getAttribute('href'); // Get the edit page URL

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to edit this user?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url; // Redirect if confirmed
                    }
                });
            });
        });

        // SweetAlert Confirmation for Delete
        document.querySelectorAll('.deletePermissionBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
