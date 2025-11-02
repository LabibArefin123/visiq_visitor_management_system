@extends('adminlte::page')

@section('title', 'Lost & Found Items')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Lost & Found Items</h3>
        <a href="{{ route('lost_and_founds.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow-lg mt-3">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Reported By</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Reported Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lostAndFounds as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->visitor->name ?? 'Unknown' }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $item->status == 'Lost' ? 'danger' : ($item->status == 'Found' ? 'info' : 'success') }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>{{ $item->location ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->reported_date)->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('lost_and_founds.show', $item->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('lost_and_founds.edit', $item->id) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('lost_and_founds.destroy', $item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No Lost & Found items available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
