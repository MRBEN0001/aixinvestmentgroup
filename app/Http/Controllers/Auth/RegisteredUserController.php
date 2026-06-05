<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Account;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd('Controller reached!');
        // dd($request->all());


        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'dob' => 'nullable|date',
            'country' => 'nullable|string',
            'city_or_state' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'country' => $request->country,
            'city_or_state' => $request->city_or_state,
            'postal_code' => $request->postal_code,
            'password' => Hash::make($request->password),
            'profile_image' => $profileImagePath,
            'role' => 'customer', // You can change this if needed
            'is_active' => 1,
            'is_notification_enable' => 1,
            'is_two_factor_auth_enable' => 1,
            'ip_address' => $request->ip(),
        ]);

        $account = Account::create([
            'user_id' => $user->id,
            'account_number' => generateUniqueAccountNumber(),
            'routine' => generateUniqueRoutingNumber(),
            'balance' => 0.00,
            'is_suspended' => false,
        ]);

        // Trigger Registered event
        event(new Registered($user));
        // Log the user in
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
