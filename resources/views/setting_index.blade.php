@extends('adminlte::page')

@section('title', 'Settings')

@section('content')
<div class="container">
    <h2 class="mb-4">Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- General Settings -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4>General Settings</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <p>Manage general settings for the system here. Customize the application to fit your needs.</p>
                    <a href="{{ route('general_setting') }}" class="btn btn-info mt-auto">Go to General Settings</a>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4>Security Settings</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <p>Control security-related settings like password policies, two-factor authentication, and more.</p>
                    <a href="{{ route('security_setting') }}" class="btn btn-warning mt-auto">Go to Security Settings</a>
                </div>
            </div>
        </div>

        <!-- User Activity Log -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4>User Activity Log</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <p>View the activity log of users in the system. Track login times, changes, and actions performed.</p>
                    <a href="{{ route('user_activity_log') }}" class="btn btn-primary mt-auto">View User Activity Log</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Notification Preferences -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4>Notification Preferences</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <p>Manage your notification preferences and choose how you want to be notified about system events.</p>
                    <a href="{{ route('notification_preferences') }}" class="btn btn-success mt-auto">Go to Notification Preferences</a>
                </div>
            </div>
        </div>

        <!-- Visitor Settings -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4>Visitor Settings</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <p>Configure settings for visitors, such as allowed visiting hours, approval processes, and more.</p>
                    <a href="{{ route('visitor_settings') }}" class="btn btn-danger mt-auto">Go to Visitor Settings</a>
                </div>
            </div>
        </div>

        <!-- Employee Access -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4>Employee Access</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <p>Manage employee access to the system. Set roles, permissions, and access control for users.</p>
                    <a href="{{ route('employee_access') }}" class="btn btn-secondary mt-auto">Go to Employee Access Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
