@extends('adminlte::page')

@section('title', 'Notification Preferences')

@section('content')
<div class="container">
    <h2>Notification Preferences</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('notifications.updatePreferences') }}" method="POST">
        @csrf

        <!-- Visitor Check-In -->
        <div class="form-group">
            <label for="visitor_check_in">Notify on Visitor Check-In</label>
            <select class="form-control" id="visitor_check_in" name="visitor_check_in" required>
                <option value="1" {{ $preferences['visitor_check_in'] ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$preferences['visitor_check_in'] ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Visitor Check-Out -->
        <div class="form-group">
            <label for="visitor_check_out">Notify on Visitor Check-Out</label>
            <select class="form-control" id="visitor_check_out" name="visitor_check_out" required>
                <option value="1" {{ $preferences['visitor_check_out'] ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$preferences['visitor_check_out'] ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Overdue Check-Out -->
        <div class="form-group">
            <label for="overdue_check_out">Notify on Overdue Check-Out</label>
            <select class="form-control" id="overdue_check_out" name="overdue_check_out" required>
                <option value="1" {{ $preferences['overdue_check_out'] ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$preferences['overdue_check_out'] ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- System Updates -->
        <div class="form-group">
            <label for="system_updates">Notify on System Updates</label>
            <select class="form-control" id="system_updates" name="system_updates" required>
                <option value="1" {{ $preferences['system_updates'] ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$preferences['system_updates'] ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

@stop
@section('footer')
    <div style="position: fixed; bottom: 5px; right: 5px; text-align: middle;">
        <p class="text-muted medium">
            Design and Developed by
            <a href="https://www.totalofftec.com" target="_blank" style="color: #007bff;">TOTALOFFTEC</a>
        </p>
    </div>
@endsection