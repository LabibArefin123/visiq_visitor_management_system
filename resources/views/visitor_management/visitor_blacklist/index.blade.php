@extends('adminlte::page')

@section('title', 'Blacklist Visitors')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Blacklist Visitors</h1>
        <a href="{{ route('visitor_blacklists.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-hover text-nowrap">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>BID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Reason for Blacklist</th>
                            <th>Blacklisted Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blacklistedVisitors as $blacklist)
                            <tr>
                                <td>{{ $blacklist->id }}</td>
                                <td>{{ $blacklist->blacklist_id ?? 'N/A' }}</td>
                                <td>{{ $blacklist->name }}</td>
                                <td>{{ $blacklist->phone }}</td>
                                <td>{{ $blacklist->reason ?? 'Not Specified' }}</td>
                                <td>{{ \Carbon\Carbon::parse($blacklist->blacklisted_at)->format('d F Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('visitor_blacklists.show', $blacklist->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('visitor_blacklists.edit', $blacklist->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('visitor_blacklists.destroy', $blacklist->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Remove this visitor from blacklist?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No blacklisted visitors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $blacklistedVisitors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
