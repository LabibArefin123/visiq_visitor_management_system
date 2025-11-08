@extends('adminlte::page')

@section('title', 'ID Card List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>ID Card List</h3>
        <a href="{{ route('id_cards.create') }}" class="btn btn-success btn-sm">Add New</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Card Number</th>
                            <th>Holder Type</th>
                            <th>Holder Name</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($idCards as $card)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $card->card_number }}</td>
                                <td>{{ ucfirst($card->holder_type) }}</td>
                                <td>{{ $card->holder->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($card->issue_date)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($card->expiry_date)->format('d F Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $card->status == 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($card->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('id_cards.show', $card->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('id_cards.edit', $card->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('id_cards.destroy', $card->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
