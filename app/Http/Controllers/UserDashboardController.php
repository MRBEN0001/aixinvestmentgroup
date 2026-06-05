<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserDashboardController extends Controller
{
    public function wallet()

    {
        // Returns the "wallet" Blade view
        return view('user-dashboard-pages.wallet');
    }
    public function userProfile()

    {
        // Returns the "user dash profile" Blade view
        return view('user-dashboard-pages.user-profile');
    }
    public function settings()

    {
        // Returns the "settings" Blade view
        // return view('user-dashboard-pages.settings');

 
    $user = Auth::user(); // get the authenticated user
    return view('user-dashboard-pages.settings', compact('user'));


    }
}
