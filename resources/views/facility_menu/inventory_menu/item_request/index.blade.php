@extends('adminlte::page')

@section('title', 'Item Requests')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Item Requests</h3>
        <a href="{{ route('item_requests.create') }}" class="btn btn-sm btn-success">Add New</a>
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
                            <th>Supply Item</th>
                            <th>Requester</th>
                            <th>Department</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($itemRequests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->supplyList->item_name ?? 'N/A' }}</td>
                                <td>{{ $request->requester_name }}</td>
                                <td>{{ $request->department }}</td>
                                <td>{{ $request->request_type }}</td>
                                <td>{{ $request->quantity }}</td>
                                <td>{{ ucfirst($request->status) }}</td>
                                <td>
                                    <a href="{{ route('item_requests.show', $request->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('item_requests.edit', $request->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('item_requests.destroy', $request->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No item requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $itemRequests->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
