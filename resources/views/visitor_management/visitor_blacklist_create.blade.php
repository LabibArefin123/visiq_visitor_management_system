@extends('adminlte::page')

@section('title', 'Add Blacklisted Visitor')

@section('content')
    <div class="container">
        <h2 class="mb-4">Add Blacklisted Visitor</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('visitor_blacklist.store') }}" method="POST" id="blacklistForm">
                    @csrf

                    <!-- B_id (ID) -->
                    <div class="mb-3">
                        <label for="B_id" class="form-label">B_id</label>
                        <input type="text" id="B_id" name="B_id" class="form-control" value="{{ old('B_id') }}"
                            required>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}"
                            required>
                    </div>

                    <!-- Reason for Blacklisting -->
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Blacklisting</label>
                        <textarea id="reason" name="reason" class="form-control" required>{{ old('reason') }}</textarea>
                    </div>

                    <!-- National ID -->
                    <div class="mb-3">
                        <label for="national_id" class="form-label">National ID</label>
                        <input type="text" id="national_id" name="national_id" class="form-control"
                            value="{{ old('national_id') }}">
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitButton">Add Visitor</button>
                    <a href="{{ route('visitor_blacklist') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert2 for confirming the form submission
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission

            // SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to add this visitor to the blacklist!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, add them!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('blacklistForm').submit();
                }
            });
        });
    </script>
@endsection
