@extends('adminlte::page')

@section('title', 'Emergency Visitors')

@section('content')
<div class="container">
    <h2>Emergency Visitor List</h2>
    <a href="{{ route('visitor_emergency.create') }}" class="btn btn-danger mb-3">Add Emergency Visitor</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>E_ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Reason</th>
                <th>Emergency Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emergencyVisitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->e_id }}</td>
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->email }}</td>
                    <td>{{ $visitor->phone }}</td>
                    <td>{{ $visitor->reason }}</td>
                    <td>{{ $visitor->emergency_at }}</td>
                    <td>
                        <a href="{{ route('visitor_emergency.edit', $visitor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('visitor_emergency.delete', $visitor->id) }}" method="POST" style="display:inline;" id="deleteForm{{ $visitor->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" id="deleteButton{{ $visitor->id }}">Remove</button>
                        </form>
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
    // Add SweetAlert confirmation for Delete action
    @foreach ($emergencyVisitors as $visitor)
        document.getElementById('deleteButton{{ $visitor->id }}').addEventListener('click', function(event) {
            event.preventDefault();  // Prevent form submission

            // SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to remove this emergency visitor!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('deleteForm{{ $visitor->id }}').submit();
                }
            });
        });
    @endforeach
</script>
@endsection
