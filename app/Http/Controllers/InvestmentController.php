<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Services\InvestmentService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\InvestmentRequest;

class InvestmentController extends Controller
{
    private $investmentService;
    public function __construct(InvestmentService $investmentService)
    {
        $this->investmentService = $investmentService;
    }
    public function index()
    {
        $investments = $this->getUserInvestments();
        $account = $this->getUserAccount();
        return view('user.dashboard.investment.history')
            ->with('investments', $investments)
            ->with('account', $account);
    }

    public function cancelPendingInvestment()
    {
        $pendingInvestment = me()->investments->where('status', investmentStatuses()['pending'])->first();
        $pendingInvestment->delete();
        session()->flash('success', 'Investment Cancelled Succesfully');
        return redirect('/invest');
    }

    public function refuseInvestment()
    {
        $response = Session::get('response');
        return view('user.dashboard.investment.refuse')->with('response', $response);
    }

    public function investmentForm()
    {
        $newInvestment = Investment::where('user_id', auth()->user()->id)->latest()->first();
        $investmentPlans = $this->getInvestmentPlans();
        $coins = $this->getUserCoins();
        return view('user.dashboard.investment.form')->with('investmentPlans', $investmentPlans)->with('coins', $coins)->with('newInvestment', $newInvestment);
    }

    public function invest(InvestmentRequest $request)
    {
        if (me()->is_investing_suspended) {
            $response = 'The selected plan is no longer available for this account.';
            Session::put('response', $response);
            return redirect('/refuse-investment');
        }
        $response = "";
        $investment = lastInvestment(me()->id);
        if ($investment) {
            // if (!$investment->transaction_reference) {
            //     return redirect('/investment/obtain-wallet-address');
            // }
            if (($investment->status == investmentStatuses()['active']) || ($investment->status == investmentStatuses()['pending'])) {
                $response = 'You cannot re-invest when you have an active investment';
                Session::put('response', $response);
                return redirect('/refuse-investment');
            }
        }
        $investment = $this->investmentService->createInvestment($request);
        // if ($investment['success'] && $investment['payment_option'] == 'deposit') {
        //     session()->flash('success', $investment['message']);
        //     return redirect('/investment/obtain-wallet-address');
        // }
        if ($investment['success']) {
            session()->flash('success', $investment['message']);
            return redirect()->route('investments');
        }
        if (!$investment['success']) {
            session()->flash('danger', $investment['message'] ?? "Amount for the selected plan must not be more than $" . $this->maxInvestmentAmount($request->plan) . " or less than $" . $this->minInvestmentAmount($request->plan));
            return redirect('/invest');
        }
    }

    public function obtainAssociatedWalletAddress()
    {
        $newInvestment = Investment::where('user_id', auth()->user()->id)->latest()->first();
        $walletAddress = $this->investmentService->getWalletAddress($newInvestment->company_wallet_id);
        return view('user.dashboard.investment.reference')->with('walletAddress', $walletAddress)->with('newInvestment', $newInvestment);
    }

    public function saveReference(Request $request, $id)
    {
        try {
            $this->investmentService->saveTransactionReference($request->transactionReference, $id);
            session()->flash('success', 'Congratulation! You investment is now active.');
            return redirect()->route('investments');
        } catch (\Throwable $th) {
            session('danger', 'An error occured, we could not process transaction reference');
        }
    }
}
