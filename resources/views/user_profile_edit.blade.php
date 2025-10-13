@extends('adminlte::page')

@section('title', 'Edit User Profile')

@section('content')
    <div class="container">
        <h2>Edit Profile</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user_profile_update') }}" method="POST" enctype="multipart/form-data" id="profileUpdateForm">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_1">Phone 1</label>
                        <input type="text" name="phone_1" id="phone_1"
                            class="form-control @error('phone_1') is-invalid @enderror"
                            value="{{ old('phone_1', $user->phone_1) }}">
                        @error('phone_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_2">Phone 2</label>
                        <input type="text" name="phone_2" id="phone_2"
                            class="form-control @error('phone_2') is-invalid @enderror"
                            value="{{ old('phone_2', $user->phone_2) }}">
                        @error('phone_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob"
                            class="form-control @error('dob') is-invalid @enderror"
                            value="{{ old('dob', $user->dob ? date('Y-m-d', strtotime($user->dob)) : '') }}">
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nid">National ID</label>
                        <input type="text" name="nid" id="nid"
                            class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid', $user->nid) }}">
                        @error('nid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                        <select name="marital_status" id="marital_status"
                            class="form-control @error('marital_status') is-invalid @enderror">
                            <option value="single" {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="married" {{ old('marital_status', $user->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                        </select>
                        @error('marital_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror" required>
                            <option value="">Select User Type</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('user_type', $user->user_type) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture"
                            class="form-control @error('profile_picture') is-invalid @enderror">
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" id="updateProfileBtn">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert for Profile Update Button
        document.getElementById('updateProfileBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to update your profile?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('profileUpdateForm').submit(); // Submit the form if confirmed
                }
            });
        });

        // Disable back button and warn user about leaving with unsaved changes
        window.onbeforeunload = function() {
            return 'You have unsaved changes. Are you sure you want to leave?';
        };

        // Prevent going back using mouse or keyboard actions by capturing the back button or certain actions
        history.pushState(null, document.title, location.href);
        window.addEventListener('popstate', function() {
            history.pushState(null, document.title, location.href);
        });
    </script>
@endsection
