@extends('adminlte::page')

@section('title', 'Seat Allocations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Seat Allocations List</h3>
        <a href="{{ route('seat_allocations.create') }}" class="btn btn-success btn-sm d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop

@section('content')

    <div class="card mb-3 shadow-sm">
        {{-- Style css start --}}
        <style>
            .seat-box {
                transition: 0.2s;
                background: #fafafa;
            }

            .seat-box:hover {
                transform: translateY(-3px);
                background: white;
            }
        </style>

        {{-- Style css end --}}
        <div class="card-body">
            <form method="GET" action="{{ route('seat_allocations.index') }}" class="row g-3">

                <div class="col-md-3">
                    <label><strong>Filter by Room</strong></label>
                    <select name="room_list_id" class="form-control">
                        <option value="">All Rooms</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}"
                                {{ request('room_list_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->room_name }} (Level {{ $room->level }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label><strong>User Category</strong></label>
                    <select name="user_category_id" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('user_category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-filter"></i> Apply
                    </button>
                </div>

            </form>
        </div>
    </div>
    <div class="container">

        @forelse($allocations->groupBy('room_list_id') as $roomId => $seats)
            @php
                $room = $seats->first()->room;
            @endphp

            <!-- Room Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <strong>{{ $room->room_name }}</strong>
                    (Level {{ $room->level }})
                </div>

                <div class="card-body">

                    <!-- Seat Grid -->
                    <div class="row g-3">

                        @foreach ($seats as $seat)
                            @php
                                $person = $seat->employee ?? $seat->visitor;
                                $photo =
                                    $person && $person->photo ? asset($person->photo) : asset('images/default.jpg');
                            @endphp

                            <div class="col-md-2 col-6">
                                <div class="seat-box text-center p-2 shadow-sm border rounded">

                                    <!-- Picture -->
                                    <img src="{{ $photo }}" class="img-fluid rounded-circle mb-2"
                                        style="width:70px; height:70px; object-fit:cover;">

                                    <!-- Seat Number -->
                                    <h6 class="mb-1">
                                        Seat: <strong>{{ $seat->seat_number }}</strong>
                                    </h6>

                                    <!-- Name -->
                                    <div class="small text-muted">
                                        {{ $person->name ?? 'Empty Seat' }}
                                    </div>

                                    <!-- Actions -->
                                    <div class="mt-2">
                                        <a href="{{ route('seat_allocations.show', $seat->id) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('seat_allocations.edit', $seat->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        @empty
            <p class="text-center text-muted py-3">No seats found.</p>
        @endforelse

    </div>

@stop
