@extends('adminlte::page')

@section('title', 'Add Group Member')

@section('content')
    <div class="container">
        <h2>Add Group Member for {{ $visitor->name }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Include SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <form id="addMemberForm" action="{{ route('visitor_group_member.store', $visitor->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gid">Group ID</label>
                        <input type="text" name="gid" id="gid" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="purpose">Purpose</label>
                <input type="text" name="purpose" id="purpose" class="form-control" required>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('visitor_group_member.index', $visitor->id) }}" class="btn btn-secondary">Back</a>
                <button type="submit" id="confirmAddBtn" class="btn btn-success">Add Member</button>
            </div>
        </form>

        <script>
            document.getElementById("addMemberForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent actual form submission

                Swal.fire({
                    title: "Confirm Submission",
                    text: "Are you sure you want to add this member?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, add!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Success!",
                            text: "Member added successfully.",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            event.target.submit(); // Submit form after confirmation
                        });
                    }
                });
            });
        </script>


    </div>

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('confirmAddBtn').addEventListener('click', function() {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to add this group member?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, add!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('addMemberForm').submit();
                }
            });
        });
    </script>
@endsection
