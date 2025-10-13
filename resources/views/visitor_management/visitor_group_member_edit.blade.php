@extends('adminlte::page')

@section('title', 'Edit Group Member')

@section('content')
<div class="container">
    <h2>Edit Group Member</h2>
    <form id="editMemberForm" action="{{ route('visitor_group_member.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gid">Group ID</label>
                    <input type="text" id="gid" name="gid" class="form-control" value="{{ $member->gid }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $member->name }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $member->email }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $member->phone }}" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <input type="text" id="purpose" name="purpose" class="form-control" value="{{ $member->purpose }}" required>
        </div>

        <button type="submit" id="updateMemberBtn" class="btn btn-success">Update Member</button>
        <a href="{{ route('visitor_group_member.index', $member->visitor_id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('updateMemberBtn').addEventListener('click', function () {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to update this group member's details?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Updated!",
                    text: "The group member's details have been updated.",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    document.getElementById('editMemberForm').submit();
                });
            }
        });
    });

    document.getElementById('cancelBtn').addEventListener('click', function () {
        Swal.fire({
            title: "Cancel Update?",
            text: "Are you sure you want to cancel editing this member?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#6c757d",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, cancel",
            cancelButtonText: "Go Back"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('visitor_group_member.index', $member->visitor_id) }}";
            }
        });
    });
</script>
@endsection
