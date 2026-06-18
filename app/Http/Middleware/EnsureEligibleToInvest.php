<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EnsureEligibleToInvest extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = "";
        $investment = lastInvestment(me()->id);
        if ($investment) {
            if (!$investment->transaction_reference && $investment->payment_option == 'deposit') {
                return redirect('/investment/obtain-wallet-address');
            }

            if (($investment->status == investmentStatuses()['active']) || ($investment->status == investmentStatuses()['pending'])) {
                $response = 'You cannot re-invest when you have an active investment';
                Session::put('response', $response);
                return redirect('/refuse-investment');
            }
        }
        return $next($request);
    }
}
