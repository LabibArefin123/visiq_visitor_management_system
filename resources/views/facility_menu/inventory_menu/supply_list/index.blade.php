@extends('adminlte::page')

@section('title', 'Supply List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Supply List</h3>
        <a href="{{ route('supply_lists.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Add New Supply
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
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Item Code</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Reorder Level</th>
                            <th>Location</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supplyLists as $supply)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $supply->item_name }}</td>
                                <td>{{ $supply->item_code }}</td>
                                <td>{{ $supply->category ?? 'N/A' }}</td>
                                <td>{{ $supply->quantity }}</td>
                                <td>{{ $supply->unit }}</td>
                                <td>{{ $supply->reorder_level }}</td>
                                <td>{{ $supply->location }}</td>
                                <td>
                                    <a href="{{ route('supply_lists.show', $supply->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('supply_lists.edit', $supply->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('supply_lists.destroy', $supply->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No supply items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $supplyLists->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
