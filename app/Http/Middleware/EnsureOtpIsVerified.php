<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Block access if OTP is enabled and not yet verified
        if ($user && $user->is_two_factor_auth_enable && $user->otp !== null && !$user->is_admin) {
            return redirect()->route('otp.verify')->withErrors([
                'otp' => 'Please verify your OTP before proceeding.',
            ]);
        }
        return $next($request);
    }
}
