<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\OtpNotification;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    /**
     * Show the OTP verification form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('auth.otp'); // View where user will input OTP
    }

    /**
     * Verify the OTP submitted by the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {

        $user = Auth::user();

        if ($user->otp === $request->otp && Carbon::parse($user->otp_sent_at)->addMinutes(10)->isFuture()) {
            $user->otp = null;
            $user->save();

            return redirect()->route('dashboard');
        }

        return redirect()->route('otp.verify')->withErrors(['otp' => 'The OTP is invalid or expired.']);
    }

    public function resend()
    {
        $user = Auth::user();

        if ($user->otp_sent_at && Carbon::parse($user->otp_sent_at)->diffInSeconds(now()) < 60) {
            return redirect()->route('otp.verify')->withErrors([
                'otp' => 'Please wait a moment before requesting a new OTP.',
            ]);
        }

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

        return redirect()->route('otp.verify')->with('status', 'A new OTP has been sent to your email.');
    }
}
