{{-- resources/views/communication_management/announcement/show.blade.php --}}
@extends('adminlte::page')

@section('title', 'View Announcement')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Announcement</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('announcements.index') }}" class="btn btn-sm btn-secondary">Back</a>
            <a href="{{ route('announcements.edit', $announcement->id) }}" class="btn btn-sm btn-primary">Edit</a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Title</strong></label>
                        <input type="text" class="form-control" value="{{ $announcement->title }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Start Date</strong></label>
                        <input type="text" class="form-control" value="{{ $announcement->start_date->format('d M, Y') }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>End Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $announcement->end_date?->format('d M, Y') ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $announcement->status }}" readonly>
                    </div>

                    <div class="col-md-12 form-group">
                        <label><strong>Description</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $announcement->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
