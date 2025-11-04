@extends('adminlte::page')

@section('title', 'Damaged Items')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Damaged Items List</h3>
        <a href="{{ route('item_damages.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
    <div class="card shadow-lg">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Reported By</th>
                        <th>Damage Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($damages as $damage)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $damage->item_name }}</td>
                            <td>{{ $damage->quantity }}</td>
                            <td>{{ $damage->reported_by }}</td>
                            <td>{{ $damage->damage_date ? \Carbon\Carbon::parse($damage->damage_date)->format('d M, Y') : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('item_damages.show', $damage->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('item_damages.edit', $damage->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('item_damages.destroy', $damage->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No damaged items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
