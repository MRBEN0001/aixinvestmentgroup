<?php

namespace App\Services;

use App\Models\Coin;
use App\Models\CompanyWallet;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use App\Services\AixcoinPriceService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ExchangeMarketService
{
    public function __construct(private AixcoinPriceService $aixcoin)
    {
    }
    private array $liveCoins = [
        ['id' => 'bitcoin',     'name' => 'Bitcoin',  'symbol' => 'BTC'],
        ['id' => 'ethereum',    'name' => 'Ethereum', 'symbol' => 'ETH'],
        ['id' => 'tether',      'name' => 'Tether',   'symbol' => 'USDT'],
        ['id' => 'binancecoin', 'name' => 'BNB',      'symbol' => 'BNB'],
        ['id' => 'solana',      'name' => 'Solana',   'symbol' => 'SOL'],
        ['id' => 'ripple',      'name' => 'XRP',      'symbol' => 'XRP'],
        ['id' => 'cardano',     'name' => 'Cardano',  'symbol' => 'ADA'],
        ['id' => 'dogecoin',    'name' => 'Dogecoin', 'symbol' => 'DOGE'],
        ['id' => 'polkadot',    'name' => 'Polkadot', 'symbol' => 'DOT'],
    ];

    private array $coinIdsBySymbol = [
        'BTC' => 'bitcoin',
        'ETH' => 'ethereum',
        'USDT' => 'tether',
        'BNB' => 'binancecoin',
        'SOL' => 'solana',
        'XRP' => 'ripple',
        'ADA' => 'cardano',
        'DOGE' => 'dogecoin',
        'DOT' => 'polkadot',
    ];

    private array $coinLogos = [
        'BTC' => 'https://assets.coingecko.com/coins/images/1/small/bitcoin.png',
        'ETH' => 'https://assets.coingecko.com/coins/images/279/small/ethereum.png',
        'USDT' => 'https://assets.coingecko.com/coins/images/325/small/Tether.png',
        'BNB' => 'https://assets.coingecko.com/coins/images/825/small/bnb-icon2_2x.png',
        'SOL' => 'https://assets.coingecko.com/coins/images/4128/small/solana.png',
        'XRP' => 'https://assets.coingecko.com/coins/images/44/small/xrp-symbol-white-128.png',
        'ADA' => 'https://assets.coingecko.com/coins/images/975/small/cardano.png',
        'DOGE' => 'https://assets.coingecko.com/coins/images/5/small/dogecoin.png',
        'DOT' => 'https://assets.coingecko.com/coins/images/12171/small/polkadot.png',
    ];

    private array $fallback = [
        'bitcoin'     => ['price' => 67420.50, 'change' => 2.34,  'volume' => 28400000000, 'market_cap' => 1320000000000],
        'ethereum'    => ['price' => 3412.80,  'change' => 1.87,  'volume' => 15200000000, 'market_cap' => 410000000000],
        'tether'      => ['price' => 1.00,     'change' => 0.01,  'volume' => 42100000000, 'market_cap' => 95000000000],
        'binancecoin' => ['price' => 582.30,   'change' => -0.54, 'volume' => 1800000000,  'market_cap' => 89000000000],
        'solana'      => ['price' => 148.75,   'change' => 4.12,  'volume' => 3200000000,  'market_cap' => 68000000000],
        'ripple'      => ['price' => 0.62,     'change' => 1.25,  'volume' => 1400000000,  'market_cap' => 34000000000],
        'cardano'     => ['price' => 0.48,     'change' => -1.08, 'volume' => 420000000,   'market_cap' => 17000000000],
        'dogecoin'    => ['price' => 0.14,     'change' => 3.44,  'volume' => 980000000,   'market_cap' => 20000000000],
        'polkadot'    => ['price' => 7.82,     'change' => 0.96,  'volume' => 310000000,   'market_cap' => 10000000000],
    ];

    public function getCoins(): array
    {
        $market = $this->getMarketData();
        $coins = [];
        $rank = 1;
        $totalVolume = 0;

        foreach ($this->liveCoins as $index => $meta) {
            $data = $market[$meta['id']] ?? $this->fallback[$meta['id']];
            $totalVolume += $data['volume'] ?? 0;

            $coins[] = [
                'rank' => $rank++,
                'name' => $meta['name'],
                'symbol' => $meta['symbol'],
                'logo' => $this->coinLogos[$meta['symbol']] ?? null,
                'price' => $data['price'],
                'change' => $data['change'],
                'volume' => $data['volume'],
                'market_cap' => $data['market_cap'],
                'highlight' => false,
            ];

            if ($index === 1) {
                $aixPrice = $this->aixcoin->current();
                $coins[] = [
                    'rank' => $rank++,
                    'name' => 'Aixcoin',
                    'symbol' => 'AIX',
                    'logo' => null,
                    'price' => $aixPrice,
                    'change' => $this->aixcoin->change24h(),
                    'volume' => 892000000,
                    'market_cap' => $aixPrice * 8400000000,
                    'highlight' => true,
                ];
            }
        }

        return [
            'coins' => $coins,
            'totalVolume' => $totalVolume,
        ];
    }

    public function getDepositCoins(): array
    {
        $coins = $this->getCoins()['coins'];
        $featured = null;
        $rest = [];

        foreach ($coins as $coin) {
            if ($coin['highlight']) {
                $featured = $coin;
            } else {
                $rest[] = $coin;
            }
        }

        return $featured ? array_merge([$featured], $rest) : $coins;
    }

    public function getCompanyWalletForSymbol(string $symbol): ?CompanyWallet
    {
        return CompanyWallet::query()
            ->where('abbr', strtoupper($symbol))
            ->first();
    }

    public function getUserBalancesBySymbol(?User $user): array
    {
        if (! $user) {
            return [];
        }

        $balances = [];

        foreach ($user->coins()->with('companyWallet')->get() as $coin) {
            $symbol = strtoupper($coin->companyWallet->abbr ?? $coin->companyWallet->coin ?? '');
            if ($symbol !== '') {
                $balances[$symbol] = ($balances[$symbol] ?? 0) + (float) $coin->balance;
            }
        }

        return $balances;
    }

    public function getAssetsForUser(?User $user): array
    {
        $coins = $this->getCoins()['coins'];
        $balances = $this->getUserBalancesBySymbol($user);

        return collect($coins)->map(function (array $coin) use ($balances) {
            $units = (float) ($balances[$coin['symbol']] ?? 0);
            $price = (float) $coin['price'];

            return [
                'name' => $coin['name'],
                'symbol' => $coin['symbol'],
                'logo' => $coin['logo'] ?? null,
                'highlight' => $coin['highlight'],
                'balance' => $units,
                'price' => $price,
                'value_usd' => $units * $price,
            ];
        })
            ->sortByDesc(fn (array $asset) => $asset['balance'] > 0 ? 1 : 0)
            ->values()
            ->all();
    }

    public function getUserAssetBalance(?User $user): float
    {
        if (! $user) {
            return 0;
        }

        return collect($this->getAssetsForUser($user))->sum('value_usd');
    }

    public function getCoinBySymbol(string $symbol): ?array
    {
        $symbol = strtoupper($symbol);

        return collect($this->getCoins()['coins'])->firstWhere('symbol', $symbol);
    }

    public function getChartData(string $symbol, int $days = 7): array
    {
        $symbol = strtoupper($symbol);

        if ($symbol === 'AIX') {
            return $this->aixcoin->chartData($days);
        }

        $coinId = $this->coinIdsBySymbol[$symbol] ?? null;
        if (! $coinId) {
            return ['labels' => [], 'prices' => []];
        }

        return Cache::remember("aix_exchange_chart_{$symbol}_{$days}", now()->addMinutes(5), function () use ($coinId, $days) {
            try {
                $response = Http::timeout(8)->retry(2, 200)->get("https://api.coingecko.com/api/v3/coins/{$coinId}/market_chart", [
                    'vs_currency' => 'usd',
                    'days' => $days,
                ]);

                if (! $response->successful()) {
                    return $this->fallbackChart($coinId, $days);
                }

                $prices = collect($response->json('prices', []))
                    ->map(fn (array $point) => [
                        'label' => date('M j, H:i', (int) ($point[0] / 1000)),
                        'price' => round((float) $point[1], $point[1] < 1 ? 6 : 2),
                    ]);

                $priceValues = $prices->pluck('price')->values()->all();

                return $this->withChartTrend([
                    'labels' => $prices->pluck('label')->values()->all(),
                    'prices' => $priceValues,
                ]);
            } catch (\Throwable $e) {
                return $this->fallbackChart($coinId, $days);
            }
        });
    }

    private function withChartTrend(array $chart): array
    {
        $first = (float) ($chart['prices'][0] ?? 0);
        $last = (float) ($chart['prices'][array_key_last($chart['prices'])] ?? 0);

        $chart['trendUp'] = $last >= $first;
        $chart['periodChange'] = $first > 0 ? (($last - $first) / $first) * 100 : 0;

        return $chart;
    }

    public function getCoinAbout(string $symbol): array
    {
        $symbol = strtoupper($symbol);

        if ($symbol === 'AIX') {
            return [
                'title' => 'About Aixcoin',
                'sections' => [
                    [
                        'heading' => 'Cross-Chain Exchange',
                        'body' => 'AIX Exchange is a cross-chain exchange that lets you use Aixcoin to trade for any coin listed on the platform. There is no need to select a particular blockchain — simply choose the asset you want and trade across chains from one interface.',
                        'highlight' => true,
                    ],
                    [
                        'heading' => 'Real Estate Backed Digital Asset',
                        'body' => 'Aixcoin (AIX) is the native digital asset of AIX Investment Group, a real estate investment company focused on structured property opportunities, portfolio growth, and long-term asset development.',
                        'highlight' => false,
                    ],
                    [
                        'heading' => 'Real Estate Revenue Powers Liquidity',
                        'body' => 'A core part of the Aixcoin model is that revenue generated from AIX real estate operations — including rental income, property development returns, and strategic asset sales — is allocated to support Aixcoin market liquidity. This creates a tangible link between physical real estate performance and digital asset stability.',
                        'highlight' => false,
                    ],
                    [
                        'heading' => 'Liquidity & Market Support',
                        'body' => 'Liquidity reserves help support orderly trading, reduce extreme price gaps, and maintain confidence for holders participating through the AIX Exchange. Liquidity allocation is reviewed as part of the company\'s broader treasury and real estate cash-flow planning.',
                        'highlight' => false,
                    ],
                    [
                        'heading' => 'Governance & Price Management',
                        'body' => 'Unlike fully decentralized assets, Aixcoin pricing is administered through AIX Exchange controls, allowing the company to align token value with business strategy, investor communication, and real estate-backed liquidity policy.',
                        'highlight' => false,
                    ],
                    [
                        'heading' => 'Use Within the AIX Ecosystem',
                        'body' => 'Aixcoin can be held, tracked, and traded on AIX Exchange against pairs such as AIX/USDT and other listed assets. It represents participation in the company\'s digital asset layer while real estate remains the foundational source of value and liquidity support.',
                        'highlight' => false,
                    ],
                ],
            ];
        }

        $descriptions = [
            'BTC' => 'Bitcoin is the first decentralized cryptocurrency, launched in 2009. It operates on a peer-to-peer network without central authority and is widely used as a store of value and digital asset.',
            'ETH' => 'Ethereum is a decentralized blockchain platform that enables smart contracts and decentralized applications. Ether (ETH) is used to pay transaction fees and power the Ethereum ecosystem.',
            'USDT' => 'Tether (USDT) is a stablecoin pegged to the US dollar, designed to maintain a 1:1 value ratio. It is commonly used for trading and transferring value across exchanges.',
            'BNB' => 'BNB is the native token of the BNB Chain ecosystem, used for transaction fees, staking, and participation across Binance-linked products and services.',
            'SOL' => 'Solana is a high-performance blockchain designed for fast, low-cost transactions. SOL powers network fees, staking, and decentralized applications on Solana.',
            'XRP' => 'XRP is the native digital asset of the XRP Ledger, built for fast cross-border payments and institutional settlement use cases.',
            'ADA' => 'Cardano is a proof-of-stake blockchain platform focused on scalability, sustainability, and peer-reviewed development. ADA is its native token.',
            'DOGE' => 'Dogecoin began as a meme cryptocurrency and has grown into a widely traded digital asset with an active community and payment use cases.',
            'DOT' => 'Polkadot is a multi-chain network that enables different blockchains to transfer messages and value. DOT is used for governance, staking, and bonding.',
        ];

        return [
            'title' => 'About ' . ($this->getCoinBySymbol($symbol)['name'] ?? $symbol),
            'sections' => [
                [
                    'heading' => 'Overview',
                    'body' => $descriptions[$symbol] ?? 'Market data for this digital asset is provided through the AIX Exchange.',
                    'highlight' => false,
                ],
            ],
        ];
    }

    private function fallbackChart(string $coinId, int $days): array
    {
        $base = $this->fallback[$coinId]['price'] ?? 100;
        $labels = [];
        $prices = [];

        for ($i = $days * 24; $i >= 0; $i -= max(1, intdiv($days * 24, 48))) {
            $labels[] = now()->subHours($i)->format('M j, H:i');
            $prices[] = round($base * (1 + (mt_rand(-200, 200) / 10000)), $base < 1 ? 6 : 2);
        }

        return $this->withChartTrend(compact('labels', 'prices'));
    }

    private function getMarketData(): array
    {
        return Cache::remember('aix_exchange_market', now()->addMinutes(3), function () {
            try {
                $ids = collect($this->liveCoins)->pluck('id')->implode(',');

                $response = Http::timeout(8)->retry(2, 200)->get('https://api.coingecko.com/api/v3/simple/price', [
                    'ids' => $ids,
                    'vs_currencies' => 'usd',
                    'include_24hr_change' => 'true',
                    'include_24hr_vol' => 'true',
                    'include_market_cap' => 'true',
                ]);

                if (! $response->successful()) {
                    return $this->fallback;
                }

                $payload = $response->json();
                $market = [];

                foreach ($this->liveCoins as $meta) {
                    $row = $payload[$meta['id']] ?? null;
                    if (! $row) {
                        $market[$meta['id']] = $this->fallback[$meta['id']];
                        continue;
                    }

                    $market[$meta['id']] = [
                        'price' => $row['usd'] ?? $this->fallback[$meta['id']]['price'],
                        'change' => $row['usd_24h_change'] ?? 0,
                        'volume' => $row['usd_24h_vol'] ?? 0,
                        'market_cap' => $row['usd_market_cap'] ?? 0,
                    ];
                }

                return $market;
            } catch (\Throwable $e) {
                return $this->fallback;
            }
        });
    }

    public function exchangeSymbols(): array
    {
        return collect($this->getCoins()['coins'])->pluck('symbol')->all();
    }

    public function getExchangeBalancesForUser(?User $user): array
    {
        if (! $user) {
            return [];
        }

        $balances = $this->getUserBalancesBySymbol($user);

        return collect($this->getCoins()['coins'])
            ->map(fn (array $coin) => [
                'name' => $coin['name'],
                'symbol' => $coin['symbol'],
                'balance' => (float) ($balances[$coin['symbol']] ?? 0),
                'price' => (float) $coin['price'],
                'value_usd' => (float) ($balances[$coin['symbol']] ?? 0) * (float) $coin['price'],
            ])
            ->all();
    }

    public function adjustUserBalance(User $user, string $symbol, float $amount, string $operation): bool
    {
        $symbol = strtoupper($symbol);
        $amount = round($amount, 8);

        if ($amount <= 0) {
            return false;
        }

        $meta = collect($this->getCoins()['coins'])->firstWhere('symbol', $symbol);

        if (! $meta) {
            return false;
        }

        $wallet = CompanyWallet::query()->firstOrCreate(
            ['abbr' => $symbol],
            [
                'coin' => $meta['name'],
                'wallet_address' => $symbol === 'AIX' ? '' : '[]',
            ]
        );

        $coin = Coin::query()->firstOrCreate(
            [
                'user_id' => $user->id,
                'company_wallet_id' => $wallet->id,
            ],
            [
                'wallet_address' => '[]',
                'balance' => 0,
            ]
        );

        if ($operation === 'add') {
            $coin->update(['balance' => $coin->balance + $amount]);

            return true;
        }

        if ($coin->balance < $amount) {
            return false;
        }

        $coin->update(['balance' => $coin->balance - $amount]);

        return true;
    }

    public function creditApprovedDeposit(Deposit $deposit): bool
    {
        if ($deposit->source !== 'exchange' || $deposit->balance_credited) {
            return false;
        }

        $deposit->loadMissing('user', 'companyWallet');

        $user = $deposit->user;
        $wallet = $deposit->companyWallet ?? CompanyWallet::query()->where('abbr', 'AIX')->first();

        if (! $user || ! $wallet) {
            return false;
        }

        $usdAmount = (float) $deposit->amount;
        $price = max($this->aixcoin->current(), 0.0001);
        $units = round($usdAmount / $price, 8);

        DB::transaction(function () use ($deposit, $user, $wallet, $units, $usdAmount) {
            $coin = Coin::query()->firstOrCreate(
                [
                    'user_id' => $user->id,
                    'company_wallet_id' => $wallet->id,
                ],
                [
                    'wallet_address' => '[]',
                    'balance' => 0,
                ]
            );

            $coin->increment('balance', $units);

            $deposit->update([
                'balance_credited' => true,
                'credited_units' => $units,
            ]);

            if ($deposit->transaction_id) {
                $unitLabel = rtrim(rtrim(number_format($units, 8), '0'), '.') . ' AIX';

                Transaction::query()
                    ->where('id', $deposit->transaction_id)
                    ->update([
                        'status' => 'success',
                        'description' => $unitLabel . ' · $' . number_format($usdAmount, 2),
                    ]);
            }
        });

        return true;
    }

    public function declineExchangeDeposit(Deposit $deposit): bool
    {
        if ($deposit->source !== 'exchange') {
            return false;
        }

        $usdAmount = (float) $deposit->amount;
        $price = max($this->aixcoin->current(), 0.0001);
        $units = $deposit->credited_units
            ? (float) $deposit->credited_units
            : round($usdAmount / $price, 8);
        $unitLabel = rtrim(rtrim(number_format($units, 8), '0'), '.') . ' AIX';
        $description = $unitLabel . ' · $' . number_format($usdAmount, 2);

        DB::transaction(function () use ($deposit, $units, $description) {
            $deposit->update([
                'status' => 'declined',
                'credited_units' => $deposit->credited_units ?: $units,
            ]);

            if ($deposit->transaction_id) {
                Transaction::query()
                    ->where('id', $deposit->transaction_id)
                    ->update([
                        'status' => 'cancelled',
                        'description' => $description,
                    ]);
            }
        });

        return true;
    }

    public function depositAmountLabel(Deposit $deposit): string
    {
        $usdAmount = (float) $deposit->amount;
        $price = max($this->aixcoin->current(), 0.0001);
        $units = $deposit->credited_units
            ? (float) $deposit->credited_units
            : round($usdAmount / $price, 8);

        return rtrim(rtrim(number_format($units, 8), '0'), '.') . ' AIX · $' . number_format($usdAmount, 2);
    }

    public function syncApprovedExchangeDeposits(): int
    {
        $credited = 0;

        Deposit::query()
            ->where('source', 'exchange')
            ->where('status', 'approved')
            ->where('balance_credited', false)
            ->with(['user', 'companyWallet'])
            ->orderBy('id')
            ->each(function (Deposit $deposit) use (&$credited) {
                if ($this->creditApprovedDeposit($deposit)) {
                    $credited++;
                }
            });

        return $credited;
    }

    public function executeTrade(User $user, string $fromSymbol, string $toSymbol, float $amount): array
    {
        $fromSymbol = strtoupper($fromSymbol);
        $toSymbol = strtoupper($toSymbol);
        $amount = round($amount, 8);

        if ($amount <= 0) {
            return ['success' => false, 'message' => 'Enter a valid trade amount.'];
        }

        if ($fromSymbol === $toSymbol) {
            return ['success' => false, 'message' => 'Choose two different coins to trade.'];
        }

        $fromCoin = $this->getCoinBySymbol($fromSymbol);
        $toCoin = $this->getCoinBySymbol($toSymbol);

        if (! $fromCoin || ! $toCoin) {
            return ['success' => false, 'message' => 'One of the selected coins is not listed on the exchange.'];
        }

        $balances = $this->getUserBalancesBySymbol($user);
        $available = (float) ($balances[$fromSymbol] ?? 0);

        if ($available < $amount) {
            return [
                'success' => false,
                'message' => 'Insufficient ' . $fromSymbol . ' balance. Available: ' . rtrim(rtrim(number_format($available, 8), '0'), '.') . ' ' . $fromSymbol,
            ];
        }

        $fromPrice = max((float) $fromCoin['price'], 0.00000001);
        $toPrice = max((float) $toCoin['price'], 0.00000001);
        $feeRate = 0.001;
        $receive = round(($amount * $fromPrice / $toPrice) * (1 - $feeRate), 8);
        $usdValue = round($amount * $fromPrice, 2);

        if ($receive <= 0) {
            return ['success' => false, 'message' => 'Trade amount is too small after fees.'];
        }

        try {
            DB::transaction(function () use ($user, $fromSymbol, $toSymbol, $amount, $receive, $usdValue, $fromPrice, $toPrice) {
                if (! $this->adjustUserBalance($user, $fromSymbol, $amount, 'subtract')) {
                    throw new \RuntimeException('Insufficient balance.');
                }

                if (! $this->adjustUserBalance($user, $toSymbol, $receive, 'add')) {
                    throw new \RuntimeException('Could not credit destination coin.');
                }

                Transaction::create([
                    'user_id' => $user->id,
                    'account_id' => $user->account?->id ?? $user->id,
                    'transaction_type' => 'trade',
                    'amount' => $usdValue,
                    'description' => sprintf(
                        'Out: %s %s · In: %s %s',
                        rtrim(rtrim(number_format($amount, 8), '0'), '.'),
                        $fromSymbol,
                        rtrim(rtrim(number_format($receive, 8), '0'), '.'),
                        $toSymbol
                    ),
                    'status' => 'success',
                    'source' => 'exchange',
                ]);
            });
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => $e->getMessage() ?: 'Trade failed. Please try again.'];
        }

        $tradeMessage = sprintf(
            'Out: %s %s · In: %s %s (after 0.10%% fee)',
            rtrim(rtrim(number_format($amount, 8), '0'), '.'),
            $fromSymbol,
            rtrim(rtrim(number_format($receive, 8), '0'), '.'),
            $toSymbol
        );

        app(ExchangeMailService::class)->notifyTransaction($user, [
            'type' => 'trade',
            'title' => 'Trade Completed',
            'subject' => 'AIX Exchange Trade Confirmation',
            'message' => 'Your trade on AIX Exchange was completed successfully.',
            'amount_label' => '$' . number_format($usdValue, 2),
            'status' => 'success',
            'details' => $tradeMessage,
        ]);

        return [
            'success' => true,
            'message' => $tradeMessage,
            'received' => $receive,
            'to' => $toSymbol,
        ];
    }

    public function getExchangeTransactions(User $user, ?string $type = null)
    {
        $query = Transaction::query()
            ->where('user_id', $user->id)
            ->where('source', 'exchange')
            ->latest();

        if ($type && in_array($type, ['deposit', 'trade', 'withdrawal', 'transfer', 'purchase'], true)) {
            $query->where('transaction_type', $type);
        }

        return $query->paginate(20);
    }

    public function getWithdrawableAssets(?User $user): array
    {
        if (! $user) {
            return [];
        }

        return collect($this->getAssetsForUser($user))
            ->filter(fn (array $asset) => (float) $asset['balance'] > 0)
            ->sortByDesc(fn (array $asset) => (float) $asset['balance'])
            ->values()
            ->all();
    }

    public function requestWithdrawal(User $user, string $symbol, float $units, string $walletAddress): array
    {
        $symbol = strtoupper($symbol);
        $units = round($units, 8);
        $walletAddress = trim($walletAddress);

        if ($units <= 0) {
            return ['success' => false, 'message' => 'Enter a valid withdrawal amount.'];
        }

        if ($walletAddress === '') {
            return ['success' => false, 'message' => 'Enter a destination wallet address.'];
        }

        $coinMeta = $this->getCoinBySymbol($symbol);
        if (! $coinMeta) {
            return ['success' => false, 'message' => 'Selected coin is not listed on the exchange.'];
        }

        $balances = $this->getUserBalancesBySymbol($user);
        $available = (float) ($balances[$symbol] ?? 0);

        if ($available < $units) {
            return [
                'success' => false,
                'message' => 'Insufficient ' . $symbol . ' balance. Available: ' . $this->formatUnits($available) . ' ' . $symbol,
            ];
        }

        $price = max((float) $coinMeta['price'], 0.00000001);
        $usdValue = round($units * $price, 2);
        $unitLabel = $this->formatUnits($units) . ' ' . $symbol;
        $description = $unitLabel . ' · $' . number_format($usdValue, 2);

        try {
            $withdrawal = DB::transaction(function () use ($user, $symbol, $units, $walletAddress, $usdValue, $description, $coinMeta) {
                if (! $this->adjustUserBalance($user, $symbol, $units, 'subtract')) {
                    throw new \RuntimeException('Insufficient balance.');
                }

                $wallet = CompanyWallet::query()->firstOrCreate(
                    ['abbr' => $symbol],
                    [
                        'coin' => $coinMeta['name'],
                        'wallet_address' => $symbol === 'AIX' ? '' : '[]',
                    ]
                );

                $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'account_id' => $user->account?->id ?? $user->id,
                    'transaction_type' => 'withdrawal',
                    'amount' => $usdValue,
                    'description' => $description,
                    'status' => 'pending',
                    'source' => 'exchange',
                ]);

                return Withdrawal::create([
                    'user_id' => $user->id,
                    'company_wallet_id' => $wallet->id,
                    'transaction_id' => $transaction->id,
                    'amount' => $units,
                    'usd_value' => $usdValue,
                    'wallet_address' => $walletAddress,
                    'status' => 'pending',
                    'source' => 'exchange',
                ]);
            });
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => $e->getMessage() ?: 'Withdrawal failed. Please try again.'];
        }

        $mail = app(ExchangeMailService::class);

        $mail->notifyTransaction($user, [
            'type' => 'withdrawal',
            'title' => 'Withdrawal Submitted',
            'subject' => 'AIX Exchange Withdrawal Submitted',
            'message' => 'Your withdrawal request has been submitted and is awaiting admin approval.',
            'amount_label' => $unitLabel . ' ($' . number_format($usdValue, 2) . ')',
            'status' => 'pending',
            'reference' => $walletAddress,
            'reference_label' => 'Address',
            'details' => $description,
        ]);

        $mail->notifyAdmin([
            'type' => 'withdrawal',
            'title' => 'New Exchange Withdrawal',
            'subject' => 'AIX Exchange Withdrawal Request',
            'name' => 'Admin',
            'message' => $user->name . ' (' . $user->email . ') requested an exchange withdrawal.',
            'amount_label' => $unitLabel . ' ($' . number_format($usdValue, 2) . ')',
            'status' => 'pending',
            'reference' => $walletAddress,
            'reference_label' => 'Address',
            'details' => $description,
        ]);

        return [
            'success' => true,
            'message' => 'Withdrawal submitted successfully. Awaiting blockchain approval.',
            'withdrawal' => $withdrawal,
        ];
    }

    public function processWithdrawalStatus(Withdrawal $withdrawal, string $newStatus): array
    {
        if ($withdrawal->source !== 'exchange') {
            return ['success' => false, 'message' => 'Not an exchange withdrawal.'];
        }

        $previous = $withdrawal->status;
        $newStatus = strtolower($newStatus);

        if (! in_array($newStatus, ['approved', 'declined'], true)) {
            return ['success' => false, 'message' => 'Invalid status.'];
        }

        if ($previous === $newStatus) {
            return ['success' => true, 'message' => 'Status unchanged.'];
        }

        $withdrawal->loadMissing('user', 'companyWallet', 'transaction');
        $symbol = strtoupper($withdrawal->companyWallet?->abbr ?? 'AIX');
        $units = (float) $withdrawal->amount;
        $unitLabel = $this->formatUnits($units) . ' ' . $symbol;
        $usdValue = (float) ($withdrawal->usd_value ?? 0);

        try {
            DB::transaction(function () use ($withdrawal, $newStatus, $previous, $symbol, $units) {
                if ($newStatus === 'declined' && $previous === 'pending') {
                    if (! $this->adjustUserBalance($withdrawal->user, $symbol, $units, 'add')) {
                        throw new \RuntimeException('Could not refund withdrawal balance.');
                    }
                }

                $withdrawal->update(['status' => $newStatus]);

                if ($withdrawal->transaction_id) {
                    Transaction::query()
                        ->where('id', $withdrawal->transaction_id)
                        ->update([
                            'status' => $newStatus === 'approved' ? 'success' : 'cancelled',
                        ]);
                }
            });
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }

        $mail = app(ExchangeMailService::class);

        if ($newStatus === 'approved') {
            $mail->notifyTransaction($withdrawal->user, [
                'type' => 'withdrawal',
                'title' => 'Withdrawal Approved',
                'subject' => 'AIX Exchange Withdrawal Approved',
                'message' => 'Your exchange withdrawal has been approved and is being processed to your wallet address.',
                'amount_label' => $unitLabel . ' ($' . number_format($usdValue, 2) . ')',
                'status' => 'approved',
                'reference' => $withdrawal->wallet_address,
                'reference_label' => 'Address',
                'details' => $unitLabel . ' · $' . number_format($usdValue, 2),
            ]);
        } else {
            $mail->notifyTransaction($withdrawal->user, [
                'type' => 'withdrawal',
                'title' => 'Withdrawal Declined',
                'subject' => 'AIX Exchange Withdrawal Declined',
                'message' => 'Your exchange withdrawal was declined and the coin balance has been returned to your wallet.',
                'amount_label' => $unitLabel . ' ($' . number_format($usdValue, 2) . ')',
                'status' => 'declined',
                'reference' => $withdrawal->wallet_address,
                'reference_label' => 'Address',
                'details' => $unitLabel . ' · $' . number_format($usdValue, 2),
            ]);
        }

        return ['success' => true, 'message' => 'Withdrawal ' . $newStatus . '.'];
    }

    private function formatUnits(float $units): string
    {
        return rtrim(rtrim(number_format($units, 8), '0'), '.');
    }
}
