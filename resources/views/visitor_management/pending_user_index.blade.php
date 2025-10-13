@extends('adminlte::page')

@section('title', 'Pending Visitor Log')

@section('content')
<div class="container">
    <h2>Pending Visitors</h2>
    <div class="mb-3 text-right">
        <a href="{{ route('visitor.pending_visitor.create') }}" class="btn btn-success">Add Visitor</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Visitor ID</th>  <!-- Add column for v_id -->
                <th>National ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Visit Purpose</th>
                <th>Visit Date</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingVisitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->v_id }}</td>  <!-- Display v_id -->
                    <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->email }}</td>
                    <td>{{ $visitor->phone }}</td>
                    <td>{{ $visitor->purpose }}</td>
                    <td>{{ $visitor->visit_date }}</td>
                    <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}</td>
                    <td>
                        @if($visitor->date_of_birth)
                            {{ \Carbon\Carbon::parse($visitor->date_of_birth)->age }} years
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('visitor.pending_visitor.edit', $visitor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('visitor.pending_visitor.delete', $visitor->id) }}" class="btn btn-danger btn-sm btn-delete">Delete</a>
                        <a href="{{ route('visitor.pending_visitor.approve', $visitor->id) }}" class="btn btn-success btn-sm btn-approve">Approve</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No pending visitors found.</td>  <!-- Adjust colspan -->
                </tr>
            @endforelse
        </tbody>
    </table>
      

    <!-- Display Total Pending Visitors -->
    <div class="mt-3">
        <h5>Total Pending Visitors: <strong>{{ $pendingVisitors->count() }}</strong></h5>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert for Delete Button
    document.querySelectorAll('.btn-delete').forEach((deleteButton) => {
        deleteButton.addEventListener('click', function(event) {
            event.preventDefault();
            const deleteUrl = this.href;  // Get the href of the delete button

            Swal.fire({
                title: 'Are you sure?',
                text: "This action will remove the visitor from the pending list!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;  // Redirect to the delete URL
                }
            });
        });
    });

    // SweetAlert for Approve Button
    document.querySelectorAll('.btn-approve').forEach((approveButton) => {
        approveButton.addEventListener('click', function(event) {
            event.preventDefault();
            const approveUrl = this.href;  // Get the href of the approve button

            Swal.fire({
                title: 'Are you sure?',
                text: "This action will approve the visitor!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = approveUrl;  // Redirect to the approve URL
                }
            });
        });
    });
</script>
@endsection

