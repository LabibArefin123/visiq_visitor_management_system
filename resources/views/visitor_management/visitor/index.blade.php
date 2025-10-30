@extends('adminlte::page')

@section('title', 'Visitor Log')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Visitor List</h1>
        <a href="{{ route('visitors.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-plus" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Visitor ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Purpose</th>
                            <th>Visit Date</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>National ID</th>
                            <th>Gender</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visitors as $visitor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $visitor->visitor_id }}</td>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->email ?? 'N/A' }}</td>
                                <td>{{ $visitor->purpose }}</td>
                                <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('d F Y') }}</td>
                                <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('d F Y') : 'N/A' }}
                                </td>
                                <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->age : 'N/A' }}
                                </td>
                                <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                                <td>{{ $visitor->gender ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('visitors.show', $visitor->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('visitors.edit', $visitor->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this visitor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No visitors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $visitors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
