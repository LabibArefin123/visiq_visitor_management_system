<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\UserActivityLog;
use App\Models\UserActivityLogLog;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class System_Setting extends Controller
{
    public function general_setting()
    {
        // Fetch all settings as key-value pairs
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('system_setting.general_setting', compact('settings'));
    }

    public function updateGeneralSetting(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'timezone' => 'required|string',
            'email' => 'required|email',
            'contact_number' => 'required|string|max:15',
        ]);

        // Save the settings
        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],  // Match based on the key
                ['value' => $value] // Update or insert the value
            );
        }

        // Redirect with success message
        return redirect()->route('general_setting')->with('success', 'Settings updated successfully!');
    }


    public function security_setting()
    {
        return view('system_setting.security_setting');
    }

    public function userLog()
    {
        $logs = UserActivityLog::with('user')->latest()->paginate(10);
        return view('system_setting.user_activity_log', compact('logs'));
    }

    public function notification_preferences()
    {
        $user = auth()->user();

        // Define default preferences
        $defaultPreferences = [
            'visitor_check_in' => 0,
            'visitor_check_out' => 0,
            'overdue_check_out' => 0,
            'system_updates' => 0,
        ];

        // Decode preferences if they exist, otherwise use defaults
        $userPreferences = $user->notification_preferences
            ? json_decode($user->notification_preferences, true)
            : [];

        // Merge user preferences with defaults
        $preferences = array_merge($defaultPreferences, $userPreferences);

        return view('system_setting.notification_preferences', compact('preferences'));
    }


    public function updateNotificationPreferences(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'visitor_check_in' => 'required|boolean',
            'visitor_check_out' => 'required|boolean',
            'overdue_check_out' => 'required|boolean',
            'system_updates' => 'required|boolean',
        ]);

        // Fetch user preferences (assuming each user has their own preferences)
        $user = auth()->user();

        // Save preferences
        $user->notification_preferences = [
            'visitor_check_in' => $validated['visitor_check_in'],
            'visitor_check_out' => $validated['visitor_check_out'],
            'overdue_check_out' => $validated['overdue_check_out'],
            'system_updates' => $validated['system_updates'],
        ];
        $user->save();

        // Redirect back with success message
        return redirect()->route('home')->with('success', 'Notification preferences updated successfully.');
    }

    public function visitor_settings()
    {
        return view('system_setting.visitor_settings'); // Create visitor_settings.blade.php
    }

    public function updateVisitorSettings(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'checkin_time_limit' => 'required|integer|min:1',
            'visitor_badge' => 'required|boolean',
        ]);

        // Save settings logic here
        // Example: You can use a configuration table or update environment settings
        // Example code for demonstration:
        $settings = [
            'checkin_time_limit' => $request->checkin_time_limit,
            'visitor_badge' => $request->visitor_badge,
        ];

        // Save the settings logic
        // For example, if you use a `settings` table:
        foreach ($settings as $key => $value) {
            \DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Visitor settings updated successfully.');
    }

    public function employee_access()
    {
        return view('system_setting.employee_access'); // Create employee_access.blade.php
    }

    public function reports_analytics()
    {
        return view('system_setting.reports_analytics'); // Create reports_analytics.blade.php
    }
}
