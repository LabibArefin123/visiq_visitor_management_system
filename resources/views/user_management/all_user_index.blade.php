@extends('adminlte::page')

@section('title', 'All Users')

@section('content')
    <div class="container-fluid"> <!-- Use container-fluid instead of container -->
        <h2 class="mb-3">All Users</h2> <!-- Add margin-bottom to the heading -->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card"> <!-- Wrap the table in a card to align with AdminLTE's layout -->
            <div class="card-body p-0"> <!-- Remove extra padding -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0"> <!-- Add mb-0 to remove bottom margin -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone 1</th>
                                <th>Phone 2</th>
                                <th>Address</th>
                                <th>Age</th>
                                <th>Date of Birth</th>
                                <th>National ID</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_1 ?? 'Not Provided' }}</td>
                                    <td>{{ $user->phone_2 ?? 'Not Provided' }}</td>
                                    <td>{{ $user->address ?? 'Not Provided' }}</td>
                                    <td>
                                        @if ($user->dob)
                                            {{ \Carbon\Carbon::parse($user->dob)->age }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $user->dob ? date('Y-m-d', strtotime($user->dob)) : 'Not Provided' }}</td>
                                    <td>{{ $user->nid ?? 'Not Provided' }}</td>
                                    <td>{{ ucfirst($user->gender) ?? 'Not Provided' }}</td>
                                    <td>{{ ucfirst($user->marital_status) ?? 'Not Provided' }}</td>
                                    <td>{{ $user->userType->name ?? 'Not Assigned' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm me-2 btn-confirm"
                                            data-url="{{ route('all_user_view', $user->id) }}" data-action="view">
                                            View
                                        </button>

                                        <button type="button" class="btn btn-warning btn-sm me-2 btn-confirm"
                                            data-url="{{ route('user_profile_edit', $user->id) }}" data-action="edit">
                                            Edit
                                        </button>

                                        <form action="{{ route('all_user_delete', $user->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm btn-confirm"
                                                data-action="delete">
                                                Delete
                                            </button>
                                        </form>
                                    </td>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            const confirmButtons = document.querySelectorAll('.btn-confirm');
                                    
                                            confirmButtons.forEach(button => {
                                                button.addEventListener('click', function () {
                                                    const action = button.dataset.action;
                                                    const url = button.dataset.url;
                                    
                                                    let message = '';
                                                    let confirmText = 'Yes';
                                    
                                                    switch (action) {
                                                        case 'view':
                                                            message = 'Do you want to view this user\'s details?';
                                                            break;
                                                        case 'edit':
                                                            message = 'Do you want to edit this user\'s profile?';
                                                            break;
                                                        case 'delete':
                                                            message = 'Are you sure you want to delete this user? This action cannot be undone.';
                                                            confirmText = 'Yes, delete it!';
                                                            break;
                                                    }
                                    
                                                    Swal.fire({
                                                        title: 'Confirmation',
                                                        text: message,
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonColor: action === 'delete' ? '#d33' : '#3085d6',
                                                        cancelButtonColor: '#6c757d',
                                                        confirmButtonText: confirmText
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            if (action === 'delete') {
                                                                button.closest('form').submit();
                                                            } else {
                                                                window.location.href = url;
                                                            }
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                    </script>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3"> <!-- Adjust pagination spacing -->
            {{ $users->links() }}
        </div>
    </div>
@stop
