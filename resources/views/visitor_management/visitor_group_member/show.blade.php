@extends('adminlte::page')

@section('title', 'View Visitor Group Member')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Group Member Details</h3>
        <div>
            <a href="{{ route('visitor_group_members.edit', $group->id) }}"
                class="btn btn-sm btn-primary me-2 d-inline-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('visitor_group_members.index') }}"
                class="btn btn-sm btn-secondary d-inline-flex align-items-center gap-1">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">

                {{-- Group Name --}}
                <div class="col-md-6 form-group">
                    <label><strong>Group Name</strong></label>
                    <p class="form-control">{{ $group->group_name ?? 'N/A' }}</p>
                </div>

                {{-- Total Members --}}
                <div class="col-md-6 form-group">
                    <label><strong>Total Members</strong></label>
                    <p class="form-control">{{ $group->total_group_members ?? 0 }}</p>
                </div>

                {{-- Visitors --}}
                <div class="col-md-12 form-group">
                    <label><strong>Visitors</strong></label>
                    <ul class="list-group">
                        @foreach ($group->visitor_ids ?? [] as $id)
                            @php
                                $visitor = $visitors->firstWhere('id', $id);
                            @endphp
                            @if ($visitor)
                                <li class="list-group-item">
                                    {{ $visitor->name }} ({{ $visitor->visitor_id }}) — {{ $visitor->purpose }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@stop
