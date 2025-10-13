@extends('adminlte::page')

@section('title', 'Visitor Settings')

@section('content')
    <div class="container">
        <h2>Manage Visitor Settings</h2>
        <p>Here you can configure settings related to visitors, such as check-in processes, notifications, and badges.</p>

        <!-- Example Settings -->
        <form action="{{ route('visitor_settings.update') }}" method="POST">
            @csrf
            @method('POST')
        
            <div class="form-group">
                <label for="checkin_time_limit">Visitor Check-In Time Limit (in minutes):</label>
                <input type="number" name="checkin_time_limit" id="checkin_time_limit" class="form-control" value="30">
            </div>
        
            <div class="form-group">
                <label for="visitor_badge">Enable Visitor Badges:</label>
                <select name="visitor_badge" id="visitor_badge" class="form-control">
                    <option value="1" selected>Enabled</option>
                    <option value="0">Disabled</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
        
    </div>
@stop
