<?php

use App\Models\User;
use App\Models\Account;
use App\Models\Setting;
use Illuminate\Support\Str;

if (!function_exists('imagePath')) {
    function imagePath($image)
    {
        if ($image) {
            return config('app.url') . '/storage/' . $image;
        }
        return null;
    }
}

if (!function_exists('me')) {
    function me()
    {
        return auth()->user();
    }
}

//generate random routing  number 
if (!function_exists('generateUniqueRoutingNumber')) {
    function generateUniqueRoutingNumber()
    {
        do {
            $routine = str_pad(mt_rand(0, 999999999), 9, '0', STR_PAD_LEFT);
        } while (Account::where('routine', $routine)->exists());

        return $routine;
    }
}

if (!function_exists('generateUniqueAccountNumber')) {
    function generateUniqueAccountNumber()
    {
        do {
            $accountNumber = str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (Account::where('account_number', $accountNumber)->exists());

        return $accountNumber;
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        return Setting::first();
    }
}

if (!function_exists('generateOtp')) {
    function generateOtp()
    {
        do {
            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (User::where('otp', $otp)->exists());

        return $otp;
    }
}
