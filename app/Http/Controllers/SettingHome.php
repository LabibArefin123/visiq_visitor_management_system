<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingHome extends Controller
{
    public function index()
    {
        return view('settings.setting_index');
    }

    public function general()
    {
        // Logic for general settings
        return view('settings.general');
    }

    public function security()
    {
        // Logic for security settings
        return view('settings.security');
    }

    public function activityLog()
    {
        // Logic for user activity log
        return view('settings.activity-log');
    }

    public function notifications()
    {
        // Logic for notification preferences
        return view('settings.notifications');
    }

    public function visitor()
    {
        // Logic for visitor settings
        return view('settings.visitor');
    }

    public function employeeAccess()
    {
        // Logic for employee access settings
        return view('settings.employee-access');
    }
}
