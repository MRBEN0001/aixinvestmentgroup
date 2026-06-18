<?php

namespace App\Services;

use App\Models\Coin;
use App\Models\User;
use App\Models\ReferralCommission;

class UserService
{
    public function getEarnings($id)
    {
        $earnings = User::find($id)->commissions;
        return $earnings;
    }

    public function getReferrals()
    {
        $myReferralCode = auth()->user()->referral_link;
        $referrals = User::where('referral', $myReferralCode)->get();
        return $referrals;
    }

    public function updateAccount($request, $id)
    {
        Coin::where('user_id', auth()->user()->id)->where('company_wallet_id', $request->coin)->update([
            'wallet_address' => $request->walletAddress
        ]);
        return true;
    }

    public function getReferralCommissions($id)
    {
        $user = User::find($id);
        return $user->commissions;
    }
}
