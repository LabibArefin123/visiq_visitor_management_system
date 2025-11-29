@extends('adminlte::page')

@section('title', 'Visitor ID Card List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Visitor ID Card List</h3>
        <a href="{{ route('visitor_id_cards.create') }}" class="btn btn-success btn-sm">Add New</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow">
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
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visitorIdCards as $card)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $card->card_number }}</td>
                                <td>{{ ucfirst($card->holder_type) }}</td>
                                <td>{{ $card->holder->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($card->issue_date)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($card->expiry_date)->format('d F Y') }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'active' => 'success', // green
                                            'pending' => 'warning', // yellow
                                            'expired' => 'danger', // red
                                            'inactive' => 'secondary', // grey (default)
                                        ];

                                        $color = $statusColors[$card->status] ?? 'secondary';
                                    @endphp

                                    <span class="badge bg-{{ $color }}">
                                        {{ ucfirst($card->status) }}
                                    </span>
                                </td>

                                <td>{{ $card->remarks ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('visitor_id_cards.show', $card->id) }}"
                                        class="btn btn-info btn-sm">View</a>

                                    <a href="{{ route('visitor_id_cards.edit', $card->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>

                                    {{-- ✅ Approve Button — Only Admin Can See --}}
                                    @hasrole('admin')
                                        @if ($card->status === 'pending')
                                            <form action="{{ route('visitor_id_cards.approve', $card->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif
                                    @endhasrole
                                    @hasrole('admin')
                                        @if ($card->status === 'active')
                                            <div class="d-flex gap-2">

                                                {{-- Stamp Format --}}
                                                <a href="{{ route('visitor_id_cards.print', ['id' => $card->id, 'format' => 'stamp']) }}"
                                                    class="btn btn-outline-primary btn-sm" target="_blank">
                                                    Print Stamp
                                                </a>

                                                {{-- A4 Format --}}
                                                <a href="{{ route('visitor_id_cards.print', ['id' => $card->id, 'format' => 'a4']) }}"
                                                    class="btn btn-outline-dark btn-sm" target="_blank">
                                                    Print A4
                                                </a>

                                            </div>
                                        @endif
                                    @endhasrole

                                    <form action="{{ route('visitor_id_cards.destroy', $card->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('visitor_id_cards.destroy', $card->id) }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
