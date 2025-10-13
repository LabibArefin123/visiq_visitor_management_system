@extends('adminlte::page')

@section('title', 'Visitor Blacklist')

@section('content')
<div class="container">
    <h2>Visitor Blacklist</h2>
    <a href="{{ route('visitor_blacklist.create') }}" class="btn btn-danger mb-3">Add Blacklisted Visitor</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>B_id</th> <!-- Added B_id column -->
                <th>National ID</th> <!-- Added National ID column -->
                <th>Name</th>
                <th>Phone</th>
                <th>Reason</th>
                <th>Blacklisted Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blacklistedVisitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->B_id }}</td> <!-- Display B_id -->
                    <td>{{ $visitor->national_id }}</td> <!-- Display National ID -->
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->phone }}</td>
                    <td>{{ $visitor->reason }}</td>
                    <td>{{ $visitor->blacklisted_at }}</td>
                    <td>
                        <a href="{{ route('visitor_blacklist.edit', $visitor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm btn-remove" data-id="{{ $visitor->id }}">Remove</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Handle the Remove button click
    document.querySelectorAll('.btn-remove').forEach(function(button) {
        button.addEventListener('click', function() {
            var visitorId = this.getAttribute('data-id');
            
            // SweetAlert2 confirmation for deletion
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to remove this visitor from the blacklist!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete route
                    window.location.href = '/visitor_blacklist/delete/' + visitorId;
                }
            });
        });
    });
</script>
@endsection
