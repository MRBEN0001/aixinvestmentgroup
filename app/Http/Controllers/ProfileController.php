<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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
    $user = $request->user(); // ← Using $user consistently

    // Fill user data with validated input
    $user->fill($request->validated());

    // // Check if the email was updated and reset the verification timestamp
    // if ($user->isDirty('email')) {
    //     $user->email_verified_at = null;
    // }

    // // Handle profile image upload
    // if ($request->hasFile('profile_image')) {
    //     // Delete old image if exists
    //     if ($user->profile_image) {
    //         Storage::disk('public')->delete($user->profile_image);
    //     }

    //     // Store the new image
    //     $path = $request->file('profile_image')->store('profile_images', 'public');
    //     $user->profile_image = $path; // Assign the new image path to the user
    // }

    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        // Define destination path
        $destinationPath = public_path('profile-picture');

        // Create folder if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Delete old profile image if it exists
        if ($user->profile_image && file_exists(public_path($user->profile_image))) {
            unlink(public_path($user->profile_image));
        }

        // Save new image
        $image = $request->file('profile_image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $filename);

        // Store relative path to image
        $user->profile_image = 'profile-picture/' . $filename;
    }


    // Save updated user data
    $user->save();

    // Redirect back to the edit profile page with success message
    return Redirect::to('/settings')->with('status', 'profile-updated');
    // return Redirect::route('user-dashboard-pages.settings')->with('status', 'profile-updated');
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
}
