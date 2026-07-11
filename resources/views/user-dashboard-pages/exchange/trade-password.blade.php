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

    .aix-tp-panel {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        max-width: 520px;
        padding: 28px;
    }

    .aix-tp-panel h1 {
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    .aix-tp-panel > p {
        color: var(--aix-muted);
        margin-bottom: 24px;
    }

    .aix-tp-alert {
        border-radius: 12px;
        font-size: 14px;
        margin-bottom: 18px;
        padding: 12px 14px;
    }

    .aix-tp-alert.is-success {
        background: rgba(32, 165, 94, 0.15);
        border: 1px solid rgba(32, 165, 94, 0.4);
        color: #86efac;
    }

    .aix-tp-alert.is-error {
        background: rgba(194, 52, 52, 0.15);
        border: 1px solid rgba(194, 52, 52, 0.4);
        color: #fca5a5;
    }

    .aix-tp-field {
        margin-bottom: 16px;
    }

    .aix-tp-field label {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        letter-spacing: 0.6px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-tp-input {
        background: var(--aix-panel-soft);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        color: #fff;
        padding: 12px 14px;
        width: 100%;
    }

    .aix-tp-input:focus {
        border-color: var(--aix-gold);
        outline: none;
    }

    .aix-tp-btn {
        background: linear-gradient(135deg, #b08361, #8f6648);
        border: 0;
        border-radius: 12px;
        color: #fff;
        font-weight: 700;
        margin-top: 8px;
        padding: 14px 24px;
        text-transform: uppercase;
        width: 100%;
    }

    @media (max-width: 767px) {
        .aix-tp-panel {
            padding: 20px;
        }
    }
</style>

<div class="aix-tp-panel">
    <h1>{{ $hasTradePassword ? 'Update Trade Password' : 'Set Trade Password' }}</h1>
    <p>This password is required before any trade is approved on AIX Exchange.</p>

    @if (session('success'))
        <div class="aix-tp-alert is-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="aix-tp-alert is-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('aix.exchange.trade-password.save') }}" method="POST">
        @csrf

        <div class="aix-tp-field">
            <label for="trade_password">Trade Password</label>
            <input
                id="trade_password"
                name="trade_password"
                type="password"
                class="aix-tp-input"
                placeholder="Enter trade password"
                required
                minlength="4"
                autocomplete="new-password"
            >
        </div>

        <div class="aix-tp-field">
            <label for="trade_password_confirmation">Confirm Password</label>
            <input
                id="trade_password_confirmation"
                name="trade_password_confirmation"
                type="password"
                class="aix-tp-input"
                placeholder="Confirm trade password"
                required
                minlength="4"
                autocomplete="new-password"
            >
        </div>

        <button type="submit" class="aix-tp-btn">
            {{ $hasTradePassword ? 'Update Password' : 'Save Password' }}
        </button>
    </form>
</div>
@endsection
