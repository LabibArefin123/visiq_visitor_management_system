<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting_management.setting.index');
    }

    public function show2FA()
    {
        $user = auth()->user();
        return view('setting_management.setting.2fa', compact('user'));
    }

    // Toggle 2FA on/off
    public function toggle2FA()
    {
        $user = auth()->user();

        // Only allow disabling if 2FA is verified
        $twoFactorVerified = !$user->two_factor_code; // null means verified

        if ($user->two_factor_enabled && !$twoFactorVerified) {
            return back()->with('error', 'You must verify 2FA before disabling it.');
        }

        $user->two_factor_enabled = !$user->two_factor_enabled;

        if ($user->two_factor_enabled) {
            // Generate new code when enabling
            $user->two_factor_code = rand(100000, 999999);
            $user->two_factor_expires_at = now()->addMinutes(10);
        } else {
            // Reset fields when disabling
            $user->two_factor_code = null;
            $user->two_factor_expires_at = null;
        }

        $user->save();

        return back()->with('success', 'Two-Factor Authentication updated successfully.');
    }

    // Verify 2FA code
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = auth()->user();

        if ($request->code != $user->two_factor_code) {
            return back()->with('error', 'Invalid 2FA code.');
        }

        // Mark verified by clearing code
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        return back()->with('success', '2FA verified successfully. You can now disable it if you want.');
    }

    // Resend 2FA code
    public function resend()
    {
        $user = auth()->user();

        if (!$user->two_factor_enabled) {
            return back()->with('error', '2FA is not enabled.');
        }

        $user->two_factor_code = rand(100000, 999999);
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        return back()->with('success', 'A new 2FA code has been sent.');
    }
}
