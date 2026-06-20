<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AccountService;

class DashboardController extends Controller
{

    public function overview()
    {
        $user = auth()->user();
        $activeInvestment = Investment::where('user_id', auth()->user()->id)->where('status', investmentStatuses()['active'])->latest()->first();
        $investmentPlans = $this->getInvestmentPlans();
        $coins = Coin::where('user_id', auth()->user()->id)->get();

        return view('user.dashboard.overview')->with('user', $user)
            ->with('coins', $coins)
            ->with('investmentPlans', $investmentPlans)
            ->with('activeInvestment', $activeInvestment);
    }

    public function plans()
    {
        return view('user.dashboard.plans', [
            'plans' => Plan::orderBy('min')->get(),
        ]);
    }
}
