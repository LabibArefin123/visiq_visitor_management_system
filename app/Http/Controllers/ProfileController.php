<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Employee;
use App\Models\PendingVisitor;
use App\Models\Role;
use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function visitor_profile()
    {
        // Retrieve the authenticated user's profile
        $user = Auth::user();

        // Return the profile view with user data
        return view('user_profile', compact('user'));
    }

    public function pictureEdit()
    {
        $user = auth()->user(); // Get the authenticated user
        return view('profile_picture_edit', compact('user'));
    }

    // Handle Profile Picture Update
    public function pictureUpdate(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // Delete the old profile picture if it exists
        if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
            Storage::delete('public/' . $user->profile_picture);
        }

        // Store the new profile picture
        $path = $request->file('profile_image')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
        $user->save();

        // Log the activity

        // Refresh user session data
        $user->refresh();

        return redirect()->route('profile')->with('success', 'Profile picture updated successfully.');
    }



    public function user_profile_edit()
    {
        $user = Auth::user();

        // Fetch all roles for user type selection
        $roles = Role::all();

        return view('user_profile_edit', compact('user', 'roles'));
    }


    /**
     * Update the authenticated user's profile.
     */
    public function user_profile_update(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone_1' => 'nullable|string|max:15',
            'phone_2' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'dob' => 'nullable|date',
            'nid' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'marital_status' => 'nullable|in:single,married',
            'user_type' => 'required|exists:roles,id', // Ensure valid role ID
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,PNG, JPG|max:2048',
        ]);

        $user = Auth::user();

        // Check if there are changes
        $changes = [];
        foreach ($request->only(['name', 'email', 'phone_1', 'phone_2', 'address', 'age', 'dob', 'nid', 'gender', 'marital_status', 'user_type']) as $field => $value) {
            if ($user->{$field} != $value) {
                $changes[$field] = ['old' => $user->{$field}, 'new' => $value];
            }
        }

        $user->fill($request->only([
            'name',
            'email',
            'phone_1',
            'phone_2',
            'address',
            'age',
            'dob',
            'nid',
            'gender',
            'marital_status',
            'user_type',
        ]));

        // Profile picture update
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imagePath = $image->store('profile_pictures', 'public');

            // Remove old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $imagePath;
        }

        $user->save();

        // Log user activity for profile update }

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Log user activity
        $this->logActivity('Password Updated', [
            'field' => 'password',
            'old_value' => '********', // Masked for security
            'new_value' => '********', // Masked for security
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    public function logActivity($action, $details = null)
    {
        $agent = new Agent();
        $ipAddress = request()->ip();
        $wifiName = $this->getWifiName();
        $device = $agent->device() ?: 'Unknown Device';
        $browser = $agent->browser() ?: 'Unknown Browser';
        $platform = $agent->platform() ?: 'Unknown OS';

        UserActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'details' => json_encode($details),
            'ip_address' => $ipAddress,
            'wifi_name' => $wifiName,
            'device' => "{$device} ({$platform} - {$browser})"
        ]);
    }

    private function getWifiName()
    {
        if (strtoupper(PHP_OS) === 'WINNT') {
            $output = shell_exec('netsh wlan show interfaces');
            if (preg_match('/SSID\s*:\s*([^\r\n]+)/', $output, $matches)) {
                return trim($matches[1]);
            }
        } elseif (strtoupper(PHP_OS) === 'LINUX') {
            $output = shell_exec("iwgetid -r");
            return trim($output);
        } elseif (strtoupper(PHP_OS) === 'DARWIN') { // macOS
            $output = shell_exec("/System/Library/PrivateFrameworks/Apple80211.framework/Versions/Current/Resources/airport -I | grep SSID");
            if (preg_match('/SSID:\s(.+)/', $output, $matches)) {
                return trim($matches[1]);
            }
        }
        return 'Unknown Wi-Fi';
    }


    public function profileManagement()
    {
        // Fetch users, employees, visitors, and pending visitors from the database
        $users = User::all();
        $employees = Employee::all();
        $visitors = Visitor::all();
        $pendingVisitors = PendingVisitor::all(); // Fetch pending visitors

        return view('profile_management', compact('users', 'employees', 'visitors', 'pendingVisitors'));
    }
}
