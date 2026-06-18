<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function publicHtmlPath(){
        $publicPath = public_path();
        return dirname(dirname($publicPath));
   }
    protected function myPendingDeposit()
    {
        return me()->deposits->whereNull('reference')->first();
    }

    protected function getInvestmentPlans()
    {
        return Plan::all();
    }

    protected function getUserAccount()
    {
        return auth()->user()->account;
    }

    protected function getUserWithdrawals()
    {
        return auth()->user()->withdrawals()->orderBy('created_at', 'desc')->get();
    }

    protected function getUserCoins()
    {
        return auth()->user()->coins;
    }

    protected function getUserInvestments()
    {
        return auth()->user()->investments()->orderBy('created_at', 'desc')->get();
    }

    protected function maxInvestmentAmount($id)
    {
        $selectedPlan = Plan::find($id);
        return $selectedPlan->max;
    }

    protected function minInvestmentAmount($id)
    {
        $selectedPlan = Plan::find($id);
        return $selectedPlan->min;
    }
}
