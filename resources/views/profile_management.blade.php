@extends('adminlte::page')

@section('title', 'Profile Management')

@section('content')
    <div class="container">
        <h2 class="mb-4">Profile Management</h2>

        <!-- Users Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4>All Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone 1</th>
                                <th>Phone 2</th>
                                <th>Age</th>
                                <th>National ID</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>User Type</th> {{-- Display user type name, not ID --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="py-2">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default.jpg') }}"
                                            alt="Profile Picture" class="rounded-circle mx-auto d-block" width="50"
                                            height="50">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_1 ?? 'N/A' }}</td>
                                    <td>{{ $user->phone_2 ?? 'N/A' }}</td>
                                    <td>
                                        @if ($user->dob)
                                            {{ \Carbon\Carbon::parse($user->dob)->age }}
                                        @else
                                            Not Provided
                                        @endif
                                    </td>
                                    <td>{{ $user->nid ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($user->gender ?? 'N/A') }}</td>
                                    <td>{{ ucfirst($user->marital_status ?? 'N/A') }}</td>
                                    <td>{{ $user->userType->name ?? 'N/A' }}</td> {{-- Display user type name --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Employees Section -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h4>Employees</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Profile</th>
                            <th>National ID</th> {{-- Added National ID --}}
                            <th>Name</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Age</th> {{-- Added Age --}}
                            <th>Date of Birth</th> {{-- Added DOB --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr class="py-2">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : asset('images/default.jpg') }}"
                                        alt="Profile Picture" class="rounded-circle mx-auto d-block" width="50"
                                        height="50">
                                </td>
                                <td>{{ $employee->national_id }}</td> {{-- Display National ID --}}
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    @if ($employee->dob)
                                        {{ \Carbon\Carbon::parse($employee->dob)->age }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $employee->dob ?? 'N/A' }}</td> {{-- Display DOB --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Visitors Section -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h4>Visitors</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Profile</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>National ID</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Visitor Type</th>
                            <th>Visit Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visitors as $visitor)
                            <tr class="py-2">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <img src="{{ $visitor->profile_picture ? asset('storage/' . $visitor->profile_picture) : asset('images/default.jpg') }}"
                                        alt="Profile Picture" class="rounded-circle mx-auto d-block" width="50"
                                        height="50">
                                </td>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                                <td>
                                    {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td>
                                    {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->age . ' years' : 'N/A' }}
                                </td>

                                <td>{{ ucfirst($visitor->gender) ?? 'N/A' }}</td>
                                <td>{{ ucfirst($visitor->visitor_type) ?? 'N/A' }}</td>
                                <td>{{ $visitor->visit_date ? $visitor->visit_date->format('Y-m-d') : 'N/A' }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No visitors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h4>Pending Visitors</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Profile</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Visit Date</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>National ID</th>
                            <th>Gender</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingVisitors as $visitor)
                            <tr class="py-2">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <img src="{{ $visitor->profile_picture ? asset('storage/' . $visitor->profile_picture) : asset('images/default.jpg') }}"
                                        alt="Profile Picture" class="rounded-circle mx-auto d-block" width="50"
                                        height="50">
                                </td>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>
                                    {{ $visitor->visit_date ? \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td>
                                    {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td>
                                    {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->age . ' years' : 'N/A' }}
                                </td>
                                <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                                <td>{{ ucfirst($visitor->gender) ?? 'N/A' }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No pending visitors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
