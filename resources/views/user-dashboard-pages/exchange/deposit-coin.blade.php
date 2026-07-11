@extends('layouts.aix-exchange')
@section('content')
<style>
    :root {
        --aix-border: rgba(176, 131, 97, 0.35);
        --aix-gold: #b08361;
        --aix-gold-light: #c9aa79;
        --aix-muted: #94a3b8;
        --aix-panel-soft: rgba(255, 255, 255, 0.04);
        --aix-text: #f8fafc;
    }

    .aix-deposit-coin-back {
        color: var(--aix-gold-light);
        display: inline-block;
        font-size: 14px;
        margin-bottom: 20px;
        text-decoration: none;
    }

    .aix-deposit-coin-back:hover {
        color: #fff;
        text-decoration: none;
    }

    .aix-deposit-coin-panel {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        max-width: 640px;
        padding: 28px;
    }

    .aix-deposit-coin-head {
        align-items: center;
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
    }

    .aix-deposit-coin-icon {
        align-items: center;
        background: var(--aix-panel-soft);
        border: 1px solid var(--aix-border);
        border-radius: 50%;
        color: var(--aix-gold-light);
        display: flex;
        font-size: 12px;
        font-weight: 700;
        height: 52px;
        justify-content: center;
        width: 52px;
    }

    .aix-deposit-coin-icon.is-featured {
        background: linear-gradient(135deg, #b08361, #8f6648);
        color: #fff;
    }

    .aix-deposit-coin-logo {
        border-radius: 50%;
        height: 52px;
        object-fit: cover;
        width: 52px;
    }

    .aix-deposit-coin-head h1 {
        color: #fff;
        font-size: 1.5rem;
        margin: 0 0 4px;
    }

    .aix-deposit-coin-head p {
        color: var(--aix-muted);
        margin: 0;
    }

    .aix-deposit-coin-field {
        margin-bottom: 18px;
    }

    .aix-deposit-coin-field span {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        letter-spacing: 0.6px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-deposit-coin-field strong,
    .aix-deposit-coin-field p {
        color: #fff;
        font-size: 15px;
        margin: 0;
        word-break: break-all;
    }

    .aix-deposit-coin-address {
        align-items: center;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        display: flex;
        gap: 12px;
        justify-content: space-between;
        padding: 14px 16px;
    }

    .aix-deposit-copy-btn {
        background: linear-gradient(135deg, #b08361, #8f6648);
        border: 0;
        border-radius: 8px;
        color: #fff;
        flex-shrink: 0;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 14px;
        text-transform: uppercase;
    }

    .aix-deposit-note {
        background: rgba(176, 131, 97, 0.12);
        border: 1px solid var(--aix-border);
        border-radius: 12px;
        color: var(--aix-gold-light);
        font-size: 14px;
        margin-top: 20px;
        padding: 14px 16px;
    }

    .aix-deposit-paid-btn {
        background: linear-gradient(135deg, #b08361, #8f6648);
        border: 0;
        border-radius: 12px;
        color: #fff;
        display: inline-block;
        font-weight: 700;
        margin-top: 24px;
        padding: 14px 24px;
        text-decoration: none;
        text-transform: uppercase;
    }

    .aix-deposit-paid-btn:hover {
        color: #fff;
        opacity: 0.92;
        text-decoration: none;
    }
</style>

<a href="{{ route('aix.exchange.deposit') }}" class="aix-deposit-coin-back">&larr; Back to coin list</a>

<div class="aix-deposit-coin-panel">
    <div class="aix-deposit-coin-head">
        @if ($coin['highlight'])
            <div class="aix-deposit-coin-icon is-featured">{{ $coin['symbol'] }}</div>
        @else
            <img src="{{ $coin['logo'] }}" alt="{{ $coin['name'] }}" class="aix-deposit-coin-logo" loading="lazy">
        @endif

        <div>
            <h1>Deposit {{ $coin['name'] }}</h1>
            <p>Send {{ $coin['symbol'] }} to the address below to fund your wallet.</p>
        </div>
    </div>

    @if ($wallet?->wallet_address)
        <div class="aix-deposit-coin-field">
            <span>{{ $coin['symbol'] }} Wallet Address</span>
            <div class="aix-deposit-coin-address">
                <p id="deposit-wallet-address">{{ $wallet->wallet_address }}</p>
                <button type="button" class="aix-deposit-copy-btn" onclick="copyDepositAddress()">Copy</button>
            </div>
        </div>
    @else
        <div class="aix-deposit-note">
            Deposit address for {{ $coin['symbol'] }} is being configured. Please contact support if you need to deposit this asset now.
        </div>
    @endif

    @if ($wallet?->wallet_address)
        <a href="{{ route('aix.exchange.deposit.transaction-hash', ['coin' => $coin['symbol']]) }}" class="aix-deposit-paid-btn">I've Sent Payment</a>
    @endif
</div>

<script>
function copyDepositAddress() {
    var address = document.getElementById('deposit-wallet-address').textContent.trim();

    navigator.clipboard.writeText(address).then(function () {
        alert('Address copied to clipboard.');
    });
}
</script>
@endsection
