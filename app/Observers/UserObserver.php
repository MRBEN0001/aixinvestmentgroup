<?php

namespace App\Observers;

use App\Mail\newReferralMail;
use App\Models\user;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\user  $user
     * @return void
     */
    // public function created(user $user)
    // {
    //     $name = $user->name;

    //     try {
    //         Mail::to($user->email)->send(new WelcomeMail([
    //             'name' => $name
    //         ]));
    //     } catch (\Throwable $error) {
    //         Log::error('SMTP network error:' . $error->getMessage());
    //     }


    //     $referralCode = $user->referral;
    //     $referer = $this->getUserReferral($referralCode);
    //     if ($referer) {
    //         try {
    //             Mail::to($referer->email)->send(new newReferralMail([
    //                 'referer' => $referer->name,
    //                 'name' => $name
    //             ]));
    //         } catch (\Throwable $th) {
    //             Log::error('SMTP network error:' . $error->getMessage());
    //         }
    //     }
    // }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\user  $user
     * @return void
     */
    public function updated(user $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\user  $user
     * @return void
     */
    public function deleted(user $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\user  $user
     * @return void
     */
    public function restored(user $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\user  $user
     * @return void
     */
    public function forceDeleted(user $user)
    {
        //
    }

    private function getUserReferral($code)
    {
        return User::where('referral_link', $code)->first();
    }
}
