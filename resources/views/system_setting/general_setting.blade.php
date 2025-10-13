@extends('adminlte::page')

@section('title', 'General Settings')

@section('content')
<div class="container">
    <h2>General Settings</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- General Settings Form -->
    <form action="{{ route('systemSettings.updateGeneralSettings') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="app_name">Application Name</label>
            <input 
                type="text" 
                class="form-control" 
                id="app_name" 
                name="app_name" 
                value="{{ old('app_name', $settings['app_name'] ?? '') }}" 
                required>
        </div>

        <div class="form-group">
            <label for="timezone">Timezone</label>
            <select 
                class="form-control" 
                id="timezone" 
                name="timezone" 
                required>
                @foreach(timezone_identifiers_list() as $timezone)
                    <option 
                        value="{{ $timezone }}" 
                        {{ old('timezone', $settings['timezone'] ?? '') === $timezone ? 'selected' : '' }}>
                        {{ $timezone }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="email">System Email</label>
            <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email" 
                value="{{ old('email', $settings['email'] ?? '') }}" 
                required>
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input 
                type="text" 
                class="form-control" 
                id="contact_number" 
                name="contact_number" 
                value="{{ old('contact_number', $settings['contact_number'] ?? '') }}" 
                required>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@stop

