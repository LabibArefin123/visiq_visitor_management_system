@extends('adminlte::page')

@section('title', 'Visitor Group Members')

@section('content')
    <div class="container">
        <h2>Group Members for {{ $visitor->name }}</h2>
        <div class="mb-3">
            <button id="addMemberBtn" class="btn btn-success">Add Member</button>
            <a href="{{ route('visitor_company.view', $visitor->id) }}" class="btn btn-secondary">Back To Owner</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>GID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Purpose</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->gid }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->purpose }}</td>
                        <td>
                            <a href="{{ route('visitor_group_member.view', $member->id) }}"
                                class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('visitor_group_member.edit', $member->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-btn"
                                data-delete-url="{{ route('visitor_group_member.delete', $member->id) }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end mt-3">
            <strong>Total Group Visitors: {{ $totalgroupvisitors }}</strong>
        </div>
    </div>
    


    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Add Member Button Confirmation
        document.getElementById('addMemberBtn').addEventListener('click', function() {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to add a new group member?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, add!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('visitor_group_member.add', $visitor->id) }}";
                }
            });
        });

        // Delete Button Confirmation
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const deleteUrl = this.getAttribute('data-delete-url');

                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#28a745",
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    </script>
@endsection
