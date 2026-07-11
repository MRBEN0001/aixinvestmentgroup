@extends('layouts.aix-exchange')
@section('content')
<style>
    .aix-exchange {
        --aix-black: #0b0f14;
        --aix-panel: #121821;
        --aix-panel-soft: #171f2b;
        --aix-border: rgba(176, 131, 97, 0.35);
        --aix-gold: #b08361;
        --aix-gold-light: #c9aa79;
        --aix-green: #22c55e;
        --aix-red: #ef4444;
        --aix-muted: #94a3b8;
        --aix-text: #f8fafc;
    }

    .aix-exchange-hero {
        background:
            linear-gradient(135deg, rgba(11, 15, 20, 0.96), rgba(18, 24, 33, 0.92)),
            radial-gradient(circle at top right, rgba(176, 131, 97, 0.22), transparent 40%);
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        color: var(--aix-text);
        margin-bottom: 24px;
        padding: 28px;
    }

    .aix-exchange-hero h1 {
        color: #fff;
        font-size: clamp(1.6rem, 4vw, 2.4rem);
        margin-bottom: 8px;
    }

    .aix-exchange-hero p {
        color: var(--aix-muted);
        margin: 0;
        max-width: 640px;
    }

    .aix-exchange-stats {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-bottom: 24px;
    }

    .aix-exchange-stat {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 14px;
        padding: 18px 20px;
    }

    .aix-exchange-stat span {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        letter-spacing: 1px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-exchange-stat strong {
        color: #fff;
        font-size: 1.35rem;
    }

    .aix-exchange-stat-deposit {
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        text-decoration: none;
        transition: border-color 0.2s ease, transform 0.2s ease;
    }

    .aix-exchange-stat-deposit:hover {
        border-color: rgba(176, 131, 97, 0.6);
        text-decoration: none;
        transform: translateY(-1px);
    }

    .aix-exchange-stat-deposit span {
        margin-bottom: 10px;
    }

    .aix-exchange-stat-deposit strong {
        background: linear-gradient(135deg, #b08361, #8f6648);
        border-radius: 10px;
        color: #fff;
        display: inline-block;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        padding: 10px 18px;
        text-transform: uppercase;
    }

    .aix-exchange-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: 1.35fr 0.65fr;
    }

    .aix-exchange-panel {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        overflow: hidden;
    }

    .aix-exchange-panel-header {
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        justify-content: space-between;
        padding: 18px 22px;
    }

    .aix-exchange-panel-header h5 {
        color: #fff;
        margin: 0;
    }

    .aix-exchange-badge {
        background: rgba(176, 131, 97, 0.16);
        border: 1px solid var(--aix-border);
        border-radius: 999px;
        color: var(--aix-gold-light);
        font-size: 12px;
        padding: 6px 12px;
    }

    .aix-exchange-table-wrap {
        overflow-x: auto;
    }

    .aix-exchange-table {
        color: var(--aix-text);
        margin: 0;
        min-width: 720px;
        width: 100%;
    }

    .aix-exchange-table thead th {
        border: 0;
        color: var(--aix-muted);
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.6px;
        padding: 14px 22px;
        text-transform: uppercase;
    }

    .aix-exchange-table tbody td {
        border-color: rgba(255, 255, 255, 0.06);
        color: var(--aix-text);
        padding: 16px 22px;
        vertical-align: middle;
    }

    .aix-exchange-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    .aix-exchange-table tbody tr.is-featured {
        background: linear-gradient(90deg, rgba(176, 131, 97, 0.18), rgba(176, 131, 97, 0.04));
    }

    .aix-coin-row {
        cursor: pointer;
    }

    .aix-coin-row:hover {
        background: rgba(176, 131, 97, 0.08) !important;
    }

    .aix-mobile-card-link {
        color: inherit;
        display: block;
        text-decoration: none;
    }

    .aix-mobile-card-link:hover {
        color: inherit;
        text-decoration: none;
    }

    .aix-coin-cell {
        align-items: center;
        display: flex;
        gap: 12px;
    }

    .aix-coin-icon {
        align-items: center;
        background: var(--aix-panel-soft);
        border: 1px solid var(--aix-border);
        border-radius: 50%;
        color: var(--aix-gold-light);
        display: flex;
        font-size: 11px;
        font-weight: 700;
        height: 40px;
        justify-content: center;
        width: 40px;
    }

    .aix-coin-icon.is-featured {
        background: linear-gradient(135deg, #b08361, #8f6648);
        color: #fff;
    }

    .aix-coin-logo {
        border-radius: 50%;
        flex-shrink: 0;
        height: 40px;
        object-fit: cover;
        width: 40px;
    }

    .aix-coin-name {
        color: #fff;
        display: block;
        font-weight: 600;
    }

    .aix-coin-symbol {
        color: var(--aix-muted);
        font-size: 12px;
    }

    .aix-change-up {
        color: var(--aix-green);
    }

    .aix-change-down {
        color: var(--aix-red);
    }

    .aix-feature-tag {
        background: rgba(176, 131, 97, 0.18);
        border: 1px solid var(--aix-border);
        border-radius: 999px;
        color: var(--aix-gold-light);
        font-size: 10px;
        margin-left: 8px;
        padding: 3px 8px;
        text-transform: uppercase;
    }

    .aix-trade-panel {
        padding: 22px;
    }

    .aix-trade-panel h5 {
        color: #fff;
        margin-bottom: 18px;
    }

    .aix-trade-field {
        margin-bottom: 16px;
    }

    .aix-trade-field label {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-trade-input,
    .aix-trade-select {
        background: var(--aix-panel-soft);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        color: #fff;
        padding: 12px 14px;
        width: 100%;
    }

    .aix-trade-input:focus,
    .aix-trade-select:focus {
        border-color: var(--aix-gold);
        box-shadow: none;
        outline: none;
    }

    .aix-trade-select-from,
    .aix-trade-select-from option {
        background: #fff;
        color: #111;
    }

    .aix-trade-select option {
        background: #fff;
        color: #111;
    }

    .aix-trade-summary {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 12px;
        margin: 18px 0;
        padding: 14px;
    }

    .aix-trade-summary div {
        color: var(--aix-muted);
        display: flex;
        font-size: 13px;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .aix-trade-summary div:last-child {
        margin-bottom: 0;
    }

    .aix-trade-summary strong {
        color: #fff;
    }

    .aix-trade-btn {
        background: linear-gradient(135deg, #b08361, #8f6648);
        border: 0;
        border-radius: 12px;
        color: #fff;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        text-transform: uppercase;
        width: 100%;
    }

    .aix-trade-btn:disabled {
        opacity: 0.7;
    }

    .aix-trade-available {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        margin-top: 6px;
    }

    .aix-trade-alert {
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 14px;
        padding: 10px 12px;
    }

    .aix-trade-alert.is-success {
        background: rgba(32, 165, 94, 0.15);
        border: 1px solid rgba(32, 165, 94, 0.4);
        color: #86efac;
    }

    .aix-trade-alert.is-error {
        background: rgba(194, 52, 52, 0.15);
        border: 1px solid rgba(194, 52, 52, 0.4);
        color: #fca5a5;
    }

    .aix-mobile-cards {
        display: none;
        gap: 14px;
        padding: 16px;
    }

    .aix-mobile-card {
        background: var(--aix-panel-soft);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 14px;
        padding: 16px;
    }

    .aix-mobile-card.is-featured {
        border-color: var(--aix-border);
        box-shadow: inset 0 0 0 1px rgba(176, 131, 97, 0.18);
    }

    .aix-mobile-card-top,
    .aix-mobile-card-meta {
        align-items: center;
        display: flex;
        justify-content: space-between;
    }

    .aix-mobile-card-meta {
        color: var(--aix-muted);
        flex-wrap: wrap;
        font-size: 13px;
        gap: 8px;
        margin-top: 12px;
    }

    @media (max-width: 991px) {
        .aix-exchange-grid {
            grid-template-columns: 1fr;
        }

        .aix-exchange-stats {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .aix-exchange-table-wrap {
            display: none;
        }

        .aix-mobile-cards {
            display: grid;
        }
    }
</style>

<div class="aix-exchange">
    <div class="aix-exchange-hero">
        <span class="aix-exchange-badge">Live Markets</span>
        <h1 class="mt-3">AIX Exchange</h1>
        <p>AIX Exchange is a cross-chain exchange — trade Aixcoin for any listed coin without selecting a particular blockchain. Swap across assets in one place with no chain switching required.</p>
    </div>

    <div class="aix-exchange-stats">
        <div class="aix-exchange-stat">
            <span>Total Value</span>
            <strong>${{ number_format($totalBalance, 2) }}</strong>
        </div>
        <div class="aix-exchange-stat">
            <span>24h Volume</span>
            <strong>${{ formatCompactNumber($totalVolume) }}</strong>
        </div>
        <a href="{{ route('aix.exchange.deposit') }}" class="aix-exchange-stat aix-exchange-stat-deposit">
            <span>Fund Wallet</span>
            <strong>Deposit</strong>
        </a>
    </div>

    <div class="aix-exchange-grid">
        <section class="aix-exchange-panel">
            <div class="aix-exchange-panel-header">
                <h5>Exchange Listed Coins</h5>
                <span class="aix-exchange-badge">Live prices</span>
            </div>

            <div class="aix-exchange-table-wrap">
                <table class="table aix-exchange-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Asset</th>
                            <th>Price</th>
                            <th>24h Change</th>
                            <th>Volume</th>
                            <th>Market Cap</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coins as $coin)
                            <tr class="aix-coin-row {{ $coin['highlight'] ? 'is-featured' : '' }}" onclick="window.location='{{ route('aix.exchange.coin', $coin['symbol']) }}'">
                                <td>{{ $coin['rank'] }}</td>
                                <td>
                                    <div class="aix-coin-cell">
                                        @include('user-dashboard-pages.exchange.partials.coin-icon', ['coin' => $coin])
                                        <div>
                                            <span class="aix-coin-name">
                                                {{ $coin['name'] }}
                                                @if ($coin['highlight'])
                                                    <span class="aix-feature-tag">Native Coin</span>
                                                @endif
                                            </span>
                                            <span class="aix-coin-symbol">{{ $coin['symbol'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($coin['price'], $coin['price'] < 1 ? 4 : 2) }}</td>
                                <td class="{{ $coin['change'] >= 0 ? 'aix-change-up' : 'aix-change-down' }}">
                                    {{ $coin['change'] >= 0 ? '+' : '' }}{{ number_format($coin['change'], 2) }}%
                                </td>
                                <td>${{ formatCompactNumber($coin['volume']) }}</td>
                                <td>${{ formatCompactNumber($coin['market_cap']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="aix-mobile-cards">
                @foreach ($coins as $coin)
                    <a href="{{ route('aix.exchange.coin', $coin['symbol']) }}" class="aix-mobile-card-link">
                    <article class="aix-mobile-card {{ $coin['highlight'] ? 'is-featured' : '' }}">
                        <div class="aix-mobile-card-top">
                            <div class="aix-coin-cell">
                                @include('user-dashboard-pages.exchange.partials.coin-icon', ['coin' => $coin])
                                <div>
                                    <span class="aix-coin-name">{{ $coin['name'] }}</span>
                                    <span class="aix-coin-symbol">#{{ $coin['rank'] }} · {{ $coin['symbol'] }}</span>
                                </div>
                            </div>
                            <strong class="text-white">${{ number_format($coin['price'], $coin['price'] < 1 ? 4 : 2) }}</strong>
                        </div>
                        <div class="aix-mobile-card-meta">
                            <span class="{{ $coin['change'] >= 0 ? 'aix-change-up' : 'aix-change-down' }}">
                                {{ $coin['change'] >= 0 ? '+' : '' }}{{ number_format($coin['change'], 2) }}%
                            </span>
                            <span>Vol: ${{ formatCompactNumber($coin['volume']) }}</span>
                            <span>MCap: ${{ formatCompactNumber($coin['market_cap']) }}</span>
                        </div>
                    </article>
                    </a>
                @endforeach
            </div>
        </section>

        <aside class="aix-exchange-panel">
            <div class="aix-trade-panel">
                <h5>Quick Trade</h5>

                @if (session('trade_success'))
                    <div class="aix-trade-alert is-success">{{ session('trade_success') }}</div>
                @endif

                @if (session('trade_error'))
                    <div class="aix-trade-alert is-error">
                        {{ session('trade_error') }}
                        @if (session('needs_trade_password') || ! ($hasTradePassword ?? false))
                            <div style="margin-top: 8px;">
                                <a href="{{ route('aix.exchange.trade-password') }}" style="color:#c9aa79;font-weight:700;text-decoration:underline;">Set Trade Password</a>
                            </div>
                        @endif
                    </div>
                @endif

                @if (! ($hasTradePassword ?? false) && ! session('trade_error'))
                    <div class="aix-trade-alert is-error">
                        Set a trade password before you can trade.
                        <div style="margin-top: 8px;">
                            <a href="{{ route('aix.exchange.trade-password') }}" style="color:#c9aa79;font-weight:700;text-decoration:underline;">Set Trade Password</a>
                        </div>
                    </div>
                @endif

                <form action="{{ route('aix.exchange.trade') }}" method="POST" id="quick-trade-form">
                    @csrf

                    <div class="aix-trade-field">
                        <label for="from-asset">From</label>
                        <select id="from-asset" name="from" class="aix-trade-select aix-trade-select-from">
                            @foreach ($coins as $coin)
                                @php
                                    $selectedFrom = old('from', 'AIX');
                                @endphp
                                <option
                                    value="{{ $coin['symbol'] }}"
                                    data-balance="{{ $balances[$coin['symbol']] ?? 0 }}"
                                    {{ $selectedFrom === $coin['symbol'] ? 'selected' : '' }}
                                >{{ $coin['name'] }} ({{ $coin['symbol'] }})</option>
                            @endforeach
                        </select>
                        <small class="aix-trade-available" id="from-available">Available: 0</small>
                    </div>

                    <div class="aix-trade-field">
                        <label for="swap-amount">Amount</label>
                        <input
                            id="swap-amount"
                            name="amount"
                            type="number"
                            class="aix-trade-input"
                            placeholder="0.00"
                            min="0"
                            step="any"
                            value="{{ old('amount') }}"
                            required
                        >
                    </div>

                    <div class="aix-trade-field">
                        <label for="to-asset">To</label>
                        <select id="to-asset" name="to" class="aix-trade-select">
                            @foreach ($coins as $coin)
                                <option value="{{ $coin['symbol'] }}" {{ old('to', 'USDT') === $coin['symbol'] ? 'selected' : '' }}>{{ $coin['name'] }} ({{ $coin['symbol'] }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="aix-trade-field">
                        <label for="trade_password">Trade Password</label>
                        <input
                            id="trade_password"
                            name="trade_password"
                            type="password"
                            class="aix-trade-input"
                            placeholder="Enter trade password"
                            autocomplete="current-password"
                            {{ ($hasTradePassword ?? false) ? 'required' : 'disabled' }}
                        >
                    </div>

                    <div class="aix-trade-summary">
                        <div><span>Estimated rate</span><strong id="swap-rate">—</strong></div>
                        <div><span>Network fee</span><strong>0.10%</strong></div>
                        <div><span>You receive</span><strong id="swap-receive">0.00</strong></div>
                    </div>

                    <button type="submit" class="aix-trade-btn" id="trade-submit-btn" {{ ($hasTradePassword ?? false) ? '' : 'disabled' }}>Trade Now</button>
                </form>
            </div>
        </aside>
    </div>
</div>

<script>
(function () {
    var prices = @json(collect($coins)->mapWithKeys(fn ($coin) => [$coin['symbol'] => $coin['price']]));
    var amountInput = document.getElementById('swap-amount');
    var fromSelect = document.getElementById('from-asset');
    var toSelect = document.getElementById('to-asset');
    var rateEl = document.getElementById('swap-rate');
    var receiveEl = document.getElementById('swap-receive');
    var availableEl = document.getElementById('from-available');
    var form = document.getElementById('quick-trade-form');
    var submitBtn = document.getElementById('trade-submit-btn');
    var hasTradePassword = @json($hasTradePassword ?? false);
    var tradePasswordUrl = @json(route('aix.exchange.trade-password'));

    function formatAmount(value) {
        return Number(value || 0).toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 8
        });
    }

    function updateAvailable() {
        var option = fromSelect.options[fromSelect.selectedIndex];
        var balance = parseFloat(option.getAttribute('data-balance') || '0');
        availableEl.textContent = 'Available: ' + formatAmount(balance) + ' ' + fromSelect.value;
    }

    function updateSwapPreview() {
        var from = fromSelect.value;
        var to = toSelect.value;
        var amount = parseFloat(amountInput.value || '0');
        var fromPrice = prices[from] || 1;
        var toPrice = prices[to] || 1;
        var rate = fromPrice / toPrice;
        var receive = amount * rate * 0.999;

        rateEl.textContent = '1 ' + from + ' ≈ ' + formatAmount(rate) + ' ' + to;
        receiveEl.textContent = formatAmount(receive) + ' ' + to;
        updateAvailable();
    }

    amountInput.addEventListener('input', updateSwapPreview);
    fromSelect.addEventListener('change', updateSwapPreview);
    toSelect.addEventListener('change', updateSwapPreview);

    form.addEventListener('submit', function (event) {
        if (! hasTradePassword) {
            event.preventDefault();
            if (window.confirm('You need to set a trade password before trading. Go set it now?')) {
                window.location.href = tradePasswordUrl;
            }
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Trading...';
    });

    updateSwapPreview();
})();
</script>
@endsection
