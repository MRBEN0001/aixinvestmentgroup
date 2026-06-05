<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Mail\OtpNotification;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = auth()->user();

    if ($user && $user->is_two_factor_auth_enable && !$user->is_admin) {
        $otp = generateOtp();  

        $user->update([
            'otp' => $otp,
            'otp_sent_at' => now(),
        ]);

        try {
            Mail::to($user->email)->send(new OtpNotification($otp));
        } catch (\Throwable $error) {
            Log::error('SMTP network error:' . $error->getMessage());
        }

        return redirect()->route('otp.verify');
    }

    return redirect()->intended(route('dashboard', absolute: false));
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
