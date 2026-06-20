<?php

use App\Models\Coin;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Withdrawal;
use App\Enums\DepositStatusEnum;
use App\Enums\InvestmentStatusEnum;
use App\Enums\WithdrawalStatusEnum;

if (!function_exists('adminMailTo')) {
    function adminMailTo(): string
    {
        return config('app.mail_to') ?: config('app.email') ?: config('mail.from.address');
    }
}

if (!function_exists('generateReferralLink')) {
    function generateReferralLink($user)
    {
        $code = $user->username; // Generate a unique code based on user ID
        $link = config('app.url') . '/register?ref=' . $code; // Build referral link 
        $user->referral_link = $code; // Save referral code to user record
        $user->save();
        return $link; // Return referral link
    }
}

if (!function_exists('getSelectedCoin')) {
    function getSelectedCoin($id)
    {
        return Coin::where('user_id', me()->id)->where('company_wallet_id', $id)->first();
    }
}


if (!function_exists('hasActiveInvestment')) {
    function hasActiveInvestment($id)
    {
        $response = "No";
        if (count(Investment::where('user_id', $id)->where('status', investmentStatuses()['active'])->get())) {
            $response = "Yes";
        }
        return $response;
    }


    if (!function_exists('me')) {
        function me()
        {
            return auth()->user();
        }
    }
}



if (!function_exists('countPendingWithdrawals')) {
    function countPendingWithdrawals($id)
    {
        return count(Withdrawal::where('user_id', $id)->where('status', withdrawalStatuses()['pending'])->get());
    }



    if (!function_exists('withdrawalStatuses')) {
        function withdrawalStatuses()
        {
            return WithdrawalStatusEnum::toSelectArray();
        }
    }
    if (!function_exists('investmentStatuses')) {
        function investmentStatuses()
        {
            return InvestmentStatusEnum::toSelectArray();
        }
    }

    if (!function_exists('depositStatuses')) {
        function depositStatuses()
        {
            return DepositStatusEnum::toSelectArray();
        }
    }

    if (!function_exists('lastInvestment')) {
        function lastInvestment($id)
        {
            return Investment::where('user_id', $id)->latest()->first();
        }
    }
}
