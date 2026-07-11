<?php

namespace App\Http\Controllers;

use App\Services\ExchangeMarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExchangeController extends Controller
{
    public function __construct(private ExchangeMarketService $market)
    {
    }

    public function index()
    {
        $data = $this->market->getCoins();
        $user = Auth::user();

        return view('user-dashboard-pages.exchange.index', [
            'coins' => $data['coins'],
            'totalBalance' => $this->market->getUserAssetBalance($user),
            'totalVolume' => $data['totalVolume'],
            'balances' => $this->market->getUserBalancesBySymbol($user),
            'hasTradePassword' => $user->hasTradePassword(),
        ]);
    }

    public function tradePasswordForm()
    {
        $user = Auth::user();

        return view('user-dashboard-pages.exchange.trade-password', [
            'hasTradePassword' => $user->hasTradePassword(),
        ]);
    }

    public function saveTradePassword(Request $request)
    {
        $request->validate([
            'trade_password' => 'required|string|min:4|max:100|confirmed',
        ], [
            'trade_password.confirmed' => 'Trade password confirmation does not match.',
            'trade_password.min' => 'Trade password must be at least 4 characters.',
        ]);

        $user = Auth::user();
        $user->trade_password = Hash::make($request->input('trade_password'));
        $user->save();

        return redirect()
            ->route('aix.exchange.trade-password')
            ->with('success', 'Trade password saved successfully.');
    }

    public function trade(Request $request)
    {
        $user = Auth::user();

        if (! $user->hasTradePassword()) {
            return redirect()
                ->route('aix.exchange')
                ->withInput()
                ->with('trade_error', 'Set a trade password first before trading.')
                ->with('needs_trade_password', true);
        }

        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'amount' => 'required|numeric|min:0.00000001',
            'trade_password' => 'required|string',
        ]);

        if (! Hash::check($request->input('trade_password'), $user->trade_password)) {
            return redirect()
                ->route('aix.exchange')
                ->withInput($request->except('trade_password'))
                ->with('trade_error', 'Incorrect trade password.');
        }

        $result = $this->market->executeTrade(
            $user,
            $request->input('from'),
            $request->input('to'),
            (float) $request->input('amount')
        );

        if (! $result['success']) {
            return redirect()
                ->route('aix.exchange')
                ->withInput($request->except('trade_password'))
                ->with('trade_error', $result['message']);
        }

        return redirect()
            ->route('aix.exchange')
            ->with('trade_success', $result['message']);
    }

    public function transactions(Request $request)
    {
        return view('user-dashboard-pages.exchange.transactions', [
            'transactions' => $this->market->getExchangeTransactions(
                Auth::user(),
                $request->query('type')
            ),
            'activeType' => $request->query('type'),
        ]);
    }

    public function myAssets()
    {
        return view('user-dashboard-pages.exchange.my-assets', [
            'assets' => $this->market->getAssetsForUser(Auth::user()),
            'totalValue' => $this->market->getUserAssetBalance(Auth::user()),
        ]);
    }

    public function withdrawal()
    {
        $user = Auth::user();

        return view('user-dashboard-pages.exchange.withdrawal', [
            'assets' => $this->market->getWithdrawableAssets($user),
            'hasTradePassword' => $user->hasTradePassword(),
        ]);
    }

    public function processWithdrawal(Request $request)
    {
        $user = Auth::user();

        if (! $user->hasTradePassword()) {
            return redirect()
                ->route('aix.exchange.withdrawal')
                ->withInput()
                ->with('error', 'Set a trade password first before withdrawing.')
                ->with('needs_trade_password', true);
        }

        $request->validate([
            'symbol' => 'required|string',
            'amount' => 'required|numeric|min:0.00000001',
            'wallet_address' => 'required|string|max:255',
            'trade_password' => 'required|string',
        ]);

        if (! Hash::check($request->input('trade_password'), $user->trade_password)) {
            return redirect()
                ->route('aix.exchange.withdrawal')
                ->withInput($request->except('trade_password'))
                ->with('error', 'Incorrect trade password.');
        }

        $result = $this->market->requestWithdrawal(
            $user,
            $request->input('symbol'),
            (float) $request->input('amount'),
            $request->input('wallet_address')
        );

        if (! $result['success']) {
            return redirect()
                ->route('aix.exchange.withdrawal')
                ->withInput($request->except('trade_password'))
                ->with('error', $result['message']);
        }

        return redirect()
            ->route('aix.exchange.transactions', ['type' => 'withdrawal'])
            ->with('success', $result['message']);
    }

    public function show(string $symbol)
    {
        $coin = $this->market->getCoinBySymbol($symbol);

        if (! $coin) {
            abort(404);
        }

        return view('user-dashboard-pages.exchange.coin-detail', [
            'coin' => $coin,
            'chart' => $this->market->getChartData($coin['symbol']),
            'about' => $this->market->getCoinAbout($coin['symbol']),
        ]);
    }

    public function deposit()
    {
        return view('user-dashboard-pages.exchange.deposit', [
            'coins' => $this->market->getDepositCoins(),
        ]);
    }

    public function depositCoin(string $symbol)
    {
        $coin = $this->market->getCoinBySymbol($symbol);

        if (! $coin) {
            abort(404);
        }

        if (strtoupper($symbol) !== 'AIX') {
            return redirect()
                ->route('aix.exchange.deposit')
                ->with('error', 'Only Aixcoin deposits are accepted. Deposit AIX and trade for other coins.');
        }

        return view('user-dashboard-pages.exchange.deposit-coin', [
            'coin' => $coin,
            'wallet' => $this->market->getCompanyWalletForSymbol($symbol),
        ]);
    }

    public function depositTransactionHash()
    {
        return view('user-dashboard-pages.exchange.deposit-transaction-hash');
    }

    public function depositTransactionHashProcess(Request $request, DepositController $depositController)
    {
        return $depositController->transactionHashProcess($request, 'exchange');
    }
}
