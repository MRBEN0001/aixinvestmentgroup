<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSettingsNotificationController extends Controller
{
public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'is_notification_enable' => 'nullable|in:on',
        'is_two_factor_auth_enable' => 'nullable|in:on',
    ]);

    // Convert checkbox values to 1 or 0
    $user->is_notification_enable = $request->has('is_notification_enable') ? 1 : 0;
    $user->is_two_factor_auth_enable = $request->has('is_two_factor_auth_enable') ? 1 : 0;

    // Try saving
    if ($user->save()) {
        return back()->with('success', 'Settings updated successfully.');
    } else {
        return back()->with('error', 'Failed to update settings.');
    }
}

}
