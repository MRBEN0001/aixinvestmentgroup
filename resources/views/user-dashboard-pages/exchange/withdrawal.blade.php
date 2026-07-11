@extends('layouts.aix-exchange')
@section('content')
<style>
    :root {
        --aix-border: rgba(176, 131, 97, 0.35);
        --aix-gold: #b08361;
        --aix-gold-light: #c9aa79;
        --aix-muted: #94a3b8;
        --aix-panel-soft: rgba(255, 255, 255, 0.04);
    }

    .aix-wd-hero {
        margin-bottom: 20px;
    }

    .aix-wd-hero h1 {
        color: #fff;
        font-size: 1.75rem;
        margin-bottom: 8px;
    }

    .aix-wd-hero p {
        color: var(--aix-muted);
        margin: 0;
        max-width: 560px;
    }

    .aix-wd-grid {
        display: grid;
        gap: 20px;
        grid-template-columns: 1fr 1fr;
    }

    .aix-wd-panel {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        overflow: hidden;
    }

    .aix-wd-panel-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        padding: 16px 20px;
    }

    .aix-wd-asset {
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        cursor: pointer;
        display: flex;
        gap: 12px;
        padding: 14px 20px;
        transition: background 0.2s ease;
        width: 100%;
        background: transparent;
        border-left: 0;
        border-right: 0;
        border-top: 0;
        text-align: left;
    }

    .aix-wd-asset:last-child {
        border-bottom: 0;
    }

    .aix-wd-asset:hover,
    .aix-wd-asset.is-selected {
        background: rgba(176, 131, 97, 0.1);
    }

    .aix-wd-logo {
        border-radius: 50%;
        height: 38px;
        object-fit: cover;
        width: 38px;
    }

    .aix-wd-icon {
        align-items: center;
        background: linear-gradient(135deg, #b08361, #8f6648);
        border-radius: 50%;
        color: #fff;
        display: flex;
        font-size: 11px;
        font-weight: 700;
        height: 38px;
        justify-content: center;
        width: 38px;
    }

    .aix-wd-meta {
        flex: 1;
        min-width: 0;
    }

    .aix-wd-name {
        color: #fff;
        display: block;
        font-weight: 600;
    }

    .aix-wd-symbol {
        color: var(--aix-muted);
        font-size: 12px;
    }

    .aix-wd-bal {
        color: #fff;
        font-weight: 700;
        text-align: right;
    }

    .aix-wd-bal small {
        color: var(--aix-muted);
        display: block;
        font-size: 11px;
        font-weight: 500;
    }

    .aix-wd-form {
        padding: 20px;
    }

    .aix-wd-field {
        margin-bottom: 14px;
    }

    .aix-wd-field label {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-wd-input,
    .aix-wd-select {
        background: var(--aix-panel-soft);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        color: #fff;
        padding: 12px 14px;
        width: 100%;
    }

    .aix-wd-input:focus,
    .aix-wd-select:focus {
        border-color: var(--aix-gold);
        outline: none;
    }

    .aix-wd-select option {
        background: #fff;
        color: #111;
    }

    .aix-wd-hint {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        margin-top: 6px;
    }

    .aix-wd-network-note {
        background: rgba(176, 131, 97, 0.12);
        border: 1px solid var(--aix-border);
        border-radius: 10px;
        color: var(--aix-gold-light);
        font-size: 13px;
        margin-bottom: 10px;
        padding: 10px 12px;
    }

    .aix-wd-network-note strong {
        color: #fff;
    }

    .aix-wd-btn {
        background: linear-gradient(135deg, #b08361, #8f6648);
        border: 0;
        border-radius: 12px;
        color: #fff;
        font-weight: 700;
        margin-top: 8px;
        padding: 14px 18px;
        text-transform: uppercase;
        width: 100%;
    }

    .aix-wd-btn:disabled {
        opacity: 0.65;
    }

    .aix-wd-alert {
        border-radius: 12px;
        font-size: 14px;
        margin-bottom: 16px;
        padding: 12px 14px;
    }

    .aix-wd-alert.is-error {
        background: rgba(194, 52, 52, 0.15);
        border: 1px solid rgba(194, 52, 52, 0.4);
        color: #fca5a5;
    }

    .aix-wd-alert.is-success {
        background: rgba(32, 165, 94, 0.15);
        border: 1px solid rgba(32, 165, 94, 0.4);
        color: #86efac;
    }

    .aix-wd-empty {
        color: var(--aix-muted);
        padding: 32px 20px;
        text-align: center;
    }

    .aix-wd-link {
        color: #c9aa79;
        font-weight: 700;
        text-decoration: underline;
    }

    @media (max-width: 900px) {
        .aix-wd-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="aix-wd-hero">
    <h1>Withdrawal</h1>
    <p>Withdraw coins you hold on AIX Exchange. Only assets with a balance are listed, highest balance first.</p>
</div>

@if (session('error'))
    <div class="aix-wd-alert is-error">
        {{ session('error') }}
        @if (session('needs_trade_password') || ! ($hasTradePassword ?? false))
            <div style="margin-top:8px;">
                <a href="{{ route('aix.exchange.trade-password') }}" class="aix-wd-link">Set Trade Password</a>
            </div>
        @endif
    </div>
@endif

@if (! ($hasTradePassword ?? false) && ! session('error'))
    <div class="aix-wd-alert is-error">
        Set a trade password before you can withdraw.
        <div style="margin-top:8px;">
            <a href="{{ route('aix.exchange.trade-password') }}" class="aix-wd-link">Set Trade Password</a>
        </div>
    </div>
@endif

@if (count($assets) === 0)
    <div class="aix-wd-panel">
        <div class="aix-wd-empty">You have no coin balances available to withdraw.</div>
    </div>
@else
    <div class="aix-wd-grid">
        <div class="aix-wd-panel">
            <h5 class="aix-wd-panel-header">Your Balances</h5>
            @foreach ($assets as $index => $asset)
                <button
                    type="button"
                    class="aix-wd-asset {{ $index === 0 ? 'is-selected' : '' }}"
                    data-symbol="{{ $asset['symbol'] }}"
                    data-balance="{{ $asset['balance'] }}"
                    data-price="{{ $asset['price'] }}"
                    onclick="selectWithdrawAsset(this)"
                >
                    @if ($asset['highlight'])
                        <div class="aix-wd-icon">{{ $asset['symbol'] }}</div>
                    @else
                        <img src="{{ $asset['logo'] }}" alt="{{ $asset['name'] }}" class="aix-wd-logo" loading="lazy">
                    @endif
                    <div class="aix-wd-meta">
                        <span class="aix-wd-name">{{ $asset['name'] }}</span>
                        <span class="aix-wd-symbol">{{ $asset['symbol'] }}</span>
                    </div>
                    <div class="aix-wd-bal">
                        {{ rtrim(rtrim(number_format($asset['balance'], 8), '0'), '.') }}
                        <small>${{ number_format($asset['value_usd'], 2) }}</small>
                    </div>
                </button>
            @endforeach
        </div>

        <div class="aix-wd-panel">
            <h5 class="aix-wd-panel-header">Withdraw Details</h5>
            <form class="aix-wd-form" action="{{ route('aix.exchange.withdrawal.process') }}" method="POST" id="withdrawal-form">
                @csrf

                <div class="aix-wd-field">
                    <label for="symbol">Coin</label>
                    <select id="symbol" name="symbol" class="aix-wd-select" required {{ ($hasTradePassword ?? false) ? '' : 'disabled' }}>
                        @foreach ($assets as $index => $asset)
                            <option
                                value="{{ $asset['symbol'] }}"
                                data-balance="{{ $asset['balance'] }}"
                                data-price="{{ $asset['price'] }}"
                                {{ old('symbol', $assets[0]['symbol'] ?? '') === $asset['symbol'] ? 'selected' : '' }}
                            >{{ $asset['name'] }} ({{ $asset['symbol'] }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="aix-wd-field">
                    <label for="amount">Amount (units)</label>
                    <input
                        id="amount"
                        name="amount"
                        type="number"
                        class="aix-wd-input"
                        step="any"
                        min="0"
                        placeholder="0.00"
                        value="{{ old('amount') }}"
                        required
                        {{ ($hasTradePassword ?? false) ? '' : 'disabled' }}
                    >
                    <small class="aix-wd-hint" id="available-hint">Available: —</small>
                    <small class="aix-wd-hint" id="usd-hint">USD value: —</small>
                </div>

                <div class="aix-wd-field">
                    <label for="wallet_address">Destination Wallet Address</label>
                    <div class="aix-wd-network-note" id="usdt-network-note" style="display:none;">
                        Submit a <strong>USDT TRON (TRC20)</strong> address only.
                    </div>
                    <input
                        id="wallet_address"
                        name="wallet_address"
                        type="text"
                        class="aix-wd-input"
                        placeholder="Paste your wallet address"
                        value="{{ old('wallet_address') }}"
                        required
                        {{ ($hasTradePassword ?? false) ? '' : 'disabled' }}
                    >
                </div>

                <div class="aix-wd-field">
                    <label for="trade_password">Trade Password</label>
                    <input
                        id="trade_password"
                        name="trade_password"
                        type="password"
                        class="aix-wd-input"
                        placeholder="Enter trade password"
                        autocomplete="current-password"
                        {{ ($hasTradePassword ?? false) ? 'required' : 'disabled' }}
                    >
                </div>

                <button type="submit" class="aix-wd-btn" id="withdraw-btn" {{ ($hasTradePassword ?? false) ? '' : 'disabled' }}>
                    Submit Withdrawal
                </button>
            </form>
        </div>
    </div>
@endif

<script>
(function () {
    var hasTradePassword = @json($hasTradePassword ?? false);
    var tradePasswordUrl = @json(route('aix.exchange.trade-password'));
    var symbolSelect = document.getElementById('symbol');
    var amountInput = document.getElementById('amount');
    var availableHint = document.getElementById('available-hint');
    var usdHint = document.getElementById('usd-hint');
    var usdtNote = document.getElementById('usdt-network-note');
    var walletInput = document.getElementById('wallet_address');
    var form = document.getElementById('withdrawal-form');
    var submitBtn = document.getElementById('withdraw-btn');

    if (! symbolSelect) {
        return;
    }

    function formatAmount(value) {
        return Number(value || 0).toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 8
        });
    }

    function selectedOption() {
        return symbolSelect.options[symbolSelect.selectedIndex];
    }

    function syncUsdtNote() {
        var isUsdt = symbolSelect.value === 'USDT';
        usdtNote.style.display = isUsdt ? 'block' : 'none';
        walletInput.placeholder = isUsdt
            ? 'Paste your USDT TRON (TRC20) address'
            : 'Paste your wallet address';
    }

    function syncHints() {
        var option = selectedOption();
        var balance = parseFloat(option.getAttribute('data-balance') || '0');
        var price = parseFloat(option.getAttribute('data-price') || '0');
        var amount = parseFloat(amountInput.value || '0');

        availableHint.textContent = 'Available: ' + formatAmount(balance) + ' ' + option.value;
        usdHint.textContent = 'USD value: $' + (amount * price).toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        amountInput.max = balance;
        syncUsdtNote();
    }

    window.selectWithdrawAsset = function (button) {
        document.querySelectorAll('.aix-wd-asset').forEach(function (el) {
            el.classList.remove('is-selected');
        });
        button.classList.add('is-selected');
        symbolSelect.value = button.getAttribute('data-symbol');
        syncHints();
    };

    symbolSelect.addEventListener('change', function () {
        var symbol = symbolSelect.value;
        document.querySelectorAll('.aix-wd-asset').forEach(function (el) {
            el.classList.toggle('is-selected', el.getAttribute('data-symbol') === symbol);
        });
        syncHints();
    });

    amountInput.addEventListener('input', syncHints);

    form.addEventListener('submit', function (event) {
        if (! hasTradePassword) {
            event.preventDefault();
            if (window.confirm('You need to set a trade password before withdrawing. Go set it now?')) {
                window.location.href = tradePasswordUrl;
            }
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
    });

    syncHints();
})();
</script>
@endsection
