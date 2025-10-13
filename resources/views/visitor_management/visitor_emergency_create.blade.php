@extends('adminlte::page')

@section('title', 'Add Emergency Visitor')

@section('content')
    <div class="container">
        <h2 class="mb-4">Add Emergency Visitor</h2>

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
                <form action="{{ route('visitor_emergency.store') }}" method="POST" id="emergencyVisitorForm">
                    @csrf

                    <!-- Name -->
                    <!-- E_ID -->
                    <div class="mb-3">
                        <label for="e_id" class="form-label">E_ID</label>
                        <input type="text" id="e_id" name="e_id" class="form-control" value="{{ old('e_id') }}"
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


                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email') }}">
                    </div>

                    <!-- Reason for Emergency -->
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Emergency</label>
                        <textarea id="reason" name="reason" class="form-control" required>{{ old('reason') }}</textarea>
                    </div>

                    <!-- Priority Level -->

                    <!-- Emergency Date -->
                    <div class="mb-3">
                        <label for="emergency_at" class="form-label">Emergency Date</label>
                        <input type="datetime-local" id="emergency_at" name="emergency_at" class="form-control"
                            value="{{ old('emergency_at') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                    <a href="{{ route('visitor_emergency.index') }}" class="btn btn-secondary">Cancel</a>
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
                text: "You are about to submit this emergency visitor!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('emergencyVisitorForm').submit();
                }
            });
        });
    </script>
@endsection
