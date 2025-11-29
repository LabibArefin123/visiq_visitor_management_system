@extends('adminlte::page')

@section('title', 'User Profile')

@section('content')
    <div class="container">
        <h2>User Profile</h2>
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div class="flex-fill">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone 1:</strong> {{ $user->phone_1 ?? 'Not Provided' }}</p>
                    <p><strong>Phone 2:</strong> {{ $user->phone_2 ?? 'Not Provided' }}</p>
                    <p><strong>Address:</strong> {{ $user->address ?? 'Not Provided' }}</p>
                    
                    <p><strong>Age:</strong> 
                        @if($user->dob)
                            {{ \Carbon\Carbon::parse($user->dob)->age }} years
                        @else
                            Not Provided
                        @endif
                    </p>
                
                    <p><strong>Date of Birth:</strong>
                        {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : 'Not Provided' }}
                    </p>
                
                    <p><strong>National ID:</strong> {{ $user->nid ?? 'Not Provided' }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($user->gender) ?? 'Not Provided' }}</p>
                    <p><strong>Marital Status:</strong> {{ ucfirst($user->marital_status) ?? 'Not Provided' }}</p>
                    <p><strong>User Type:</strong> {{ $user->userType->name ?? 'Not Assigned' }}</p>
                </div>
                
                <div class="d-flex flex-column justify-content-center align-items-center" style="width: 300px;">
                    <!-- Profile Picture -->
                    <div style="width: 300px; height: 300px;">
                        <img src="{{ $user->getProfilePictureUrl() }}" alt="Profile Picture" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    
                    <!-- Form to Edit Profile Picture -->
                    <form action="{{ route('profile_picture_update') }}" method="POST" enctype="multipart/form-data" class="text-center mt-3" id="updatePictureForm">
                        @csrf
                        @method('PUT')
                    
                        <div class="form-group">
                            <label for="profile_image" class="form-label">Change Profile Picture</label>
                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success mt-2" id="updatePictureBtn">Update Picture</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Change Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user_password_update') }}" method="POST" id="updatePasswordForm">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" id="updatePasswordBtn">Update Password</button>
                </form>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <a href="{{ route('user_profile_edit') }}" class="btn btn-primary mt-3" id="editProfileBtn">Edit Profile</a>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Update Picture Confirmation
        document.getElementById('updatePictureBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Do you want to update your profile picture?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updatePictureForm').submit(); // Submit the form if confirmed
                }
            });
        });

        // Update Password Confirmation
        document.getElementById('updatePasswordBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Do you want to update your password?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updatePasswordForm').submit(); // Submit the form if confirmed
                }
            });
        });

        // Edit Profile Confirmation
        document.getElementById('editProfileBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link action

            Swal.fire({
                title: 'Do you want to edit your profile?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, edit it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user_profile_edit') }}"; // Redirect to edit profile if confirmed
                }
            });
        });
    </script>
@endsection
