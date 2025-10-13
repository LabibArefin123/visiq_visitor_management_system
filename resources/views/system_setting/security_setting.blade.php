@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Security Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- <form action="{{ route('systemSettings.updateSecuritySettings') }}" method="POST"> --}}
    <form action="#" method="POST">
        @csrf
        <!-- Password Policies -->
        <div class="form-group">
            <label for="password_min_length">Minimum Password Length</label>
            <input type="number" class="form-control" id="password_min_length" name="password_min_length" 
                   value="" required min="6" max="20">
            {{-- <input type="number" class="form-control" id="password_min_length" name="password_min_length" 
                   value="{{ old('password_min_length', $settings['password_min_length']) }}" required min="6" max="20"> --}}
        </div>

        <div class="form-group">
            <label for="password_special_char">Require Special Characters in Password</label>
            <select class="form-control" id="password_special_char" name="password_special_char" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
                {{-- <option value="1" {{ $settings['password_special_char'] ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$settings['password_special_char'] ? 'selected' : '' }}>No</option> --}}
            </select>
        </div>

        <!-- Session Settings -->
        <div class="form-group">
            <label for="session_timeout">Session Timeout (minutes)</label>
            <input type="number" class="form-control" id="session_timeout" name="session_timeout" 
                   value="" required min="1" max="1440">
            {{-- <input type="number" class="form-control" id="session_timeout" name="session_timeout" 
                   value="{{ old('session_timeout', $settings['session_timeout']) }}" required min="1" max="1440"> --}}
        </div>

        <!-- MFA -->
        <div class="form-group">
            <label for="mfa_enabled">Enable Multi-Factor Authentication (MFA)</label>
            <select class="form-control" id="mfa_enabled" name="mfa_enabled" required>
                <option value="1">Enabled</option>
                <option value="0">Disabled</option>
                {{-- <option value="1" {{ $settings['mfa_enabled'] ? 'selected' : '' }}>Enabled</option>
                <option value="0" {{ !$settings['mfa_enabled'] ? 'selected' : '' }}>Disabled</option> --}}
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