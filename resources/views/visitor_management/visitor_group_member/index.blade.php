@extends('adminlte::page')

@section('title', 'Visitor Group Members')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Group Member List</h3>
        <a href="{{ route('visitor_group_members.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped align-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Group Name</th>
                            <th>Total Members</th>
                            <th>Visitors</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($groups as $group)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $group->group_name }}</td>
                                <td>{{ $group->total_group_members }}</td>
                                <td>
                                    @foreach ($group->visitor_ids ?? [] as $id)
                                        @php
                                            $visitor = $visitors->firstWhere('id', $id);
                                        @endphp
                                        @if ($visitor)
                                            <span class="badge bg-primary mb-1">
                                                {{ $visitor->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('visitor_group_members.show', $group->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('visitor_group_members.edit', $group->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('visitor_group_members.destroy', $group->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this group?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No visitor groups found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $groups->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
