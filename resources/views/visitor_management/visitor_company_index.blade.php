@extends('adminlte::page')

@section('title', 'Visitor Company Log')

@section('content')
    <div class="container">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <h2>Visitor Company Log</h2>
        <div class="mb-3">
            <a href="{{ route('visitor_company.create') }}" class="btn btn-success">Add Visitor</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Phone</th>
                    <th>Visit Purpose</th>
                    <th>Visit Date</th>
                    <th>DOB</th>
                    <th>Age</th>
                    <th>National ID</th>
                    <th>Gender</th>
                    <th>Visitor Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $visitor)
                    <tr>
                        <td>{{ $visitor->id }}</td>
                        <td>{{ $visitor->contact_person }}</td>
                        <td>{{ $visitor->company_name ?? 'N/A' }}</td>
                        <td>{{ $visitor->phone }}</td>
                        <td>{{ $visitor->purpose }}</td>
                        <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d') }}</td>
                        <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}</td>
                        <td>
                            @if ($visitor->date_of_birth)
                                {{ \Carbon\Carbon::parse($visitor->date_of_birth)->age }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                        <td>{{ $visitor->gender ?? 'N/A' }}</td>
                        <td>{{ $visitor->visitor_type ?? 'Single' }}</td>
                        <td>
                            <a href="{{ route('visitor_company.view', $visitor->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('visitor_company.edit', $visitor->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- DELETE BUTTON WITH SWEETALERT -->
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $visitor->id }}">Delete</button>

                            <!-- Hidden Delete Form -->
                            <form id="delete-form-{{ $visitor->id }}" action="{{ route('visitor.delete', $visitor->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Companies Section -->
        <div class="mt-4 p-3 bg-light border rounded text-center">
            <h5>Total Unique Companies: <strong>{{ $totalCompanies }}</strong></h5>
        </div>

    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const visitorId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${visitorId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@stop
