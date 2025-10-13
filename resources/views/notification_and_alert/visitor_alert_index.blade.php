@extends('adminlte::page')

@section('title', 'Visitor Alert')

@section('content')
<div class="container">
    <h2>Visitor Alerts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Alert Button -->
    <div class="mb-3 text-right">
        <a href="{{ route('visitor_alerts.create') }}" class="btn btn-success">Add New Alert</a>
    </div>

    <!-- Alerts Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Message</th>
                <th>Type</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alerts as $alert)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alert->title }}</td>
                    <td>{{ $alert->message }}</td>
                    <td>
                        <span class="badge badge-{{ $alert->type === 'info' ? 'info' : ($alert->type === 'warning' ? 'warning' : 'danger') }}">
                            {{ ucfirst($alert->type) }}
                        </span>
                    </td>
                    <td>{{ $alert->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <!-- Notify Button -->
                        <a href="{{ route('visitor_alerts.notify.form', $alert->id) }}" class="btn btn-info btn-sm">Notify</a>

                        <!-- Delete Button -->
                        <form action="{{ route('visitor_alerts.destroy', $alert->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No alerts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@stop
