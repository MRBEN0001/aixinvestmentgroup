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

    .aix-deposit-hash-back {
        color: var(--aix-gold-light);
        display: inline-block;
        font-size: 14px;
        margin-bottom: 20px;
        text-decoration: none;
    }

    .aix-deposit-hash-back:hover {
        color: #fff;
        text-decoration: none;
    }

    .aix-deposit-hash-panel {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        max-width: 640px;
        padding: 28px;
    }

    .aix-deposit-hash-panel h1 {
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    .aix-deposit-hash-panel p {
        color: var(--aix-muted);
        margin-bottom: 24px;
    }

    .aix-deposit-hash-note {
        background: rgba(176, 131, 97, 0.12);
        border: 1px solid var(--aix-border);
        border-radius: 12px;
        color: var(--aix-gold-light);
        font-size: 14px;
        margin-bottom: 24px;
        padding: 14px 16px;
    }

    .aix-deposit-hash-alert {
        border-radius: 12px;
        font-size: 14px;
        margin-bottom: 16px;
        padding: 12px 14px;
    }

    .aix-deposit-hash-alert.is-success {
        background: rgba(32, 165, 94, 0.15);
        border: 1px solid rgba(32, 165, 94, 0.4);
        color: #86efac;
    }

    .aix-deposit-hash-alert.is-error {
        background: rgba(194, 52, 52, 0.15);
        border: 1px solid rgba(194, 52, 52, 0.4);
        color: #fca5a5;
    }

    .aix-deposit-hash-field {
        margin-bottom: 16px;
    }

    .aix-deposit-hash-field label {
        color: var(--aix-muted);
        display: block;
        font-size: 12px;
        letter-spacing: 0.6px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-deposit-hash-input {
        background: var(--aix-panel-soft);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        color: #fff;
        padding: 12px 14px;
        width: 100%;
    }

    .aix-deposit-hash-input:focus {
        border-color: var(--aix-gold);
        box-shadow: none;
        outline: none;
    }

    .aix-deposit-hash-input::placeholder {
        color: #64748b;
    }

    .aix-deposit-hash-btn {
        align-items: center;
        background: linear-gradient(135deg, #b08361, #8f6648);
        border: 0;
        border-radius: 12px;
        color: #fff;
        display: inline-flex;
        font-weight: 700;
        gap: 8px;
        justify-content: center;
        margin-top: 8px;
        min-width: 160px;
        padding: 14px 24px;
        text-transform: uppercase;
    }

    .aix-deposit-hash-btn:disabled {
        opacity: 0.7;
    }

    .aix-deposit-hash-spinner {
        display: none;
        height: 16px;
        width: 16px;
    }

    .aix-deposit-hash-btn.is-loading .aix-deposit-hash-spinner {
        display: inline-block;
    }
</style>

@php
    $coinSymbol = request('coin');
    $backUrl = $coinSymbol
        ? route('aix.exchange.deposit.coin', $coinSymbol)
        : route('aix.exchange.deposit');
@endphp

<a href="{{ $backUrl }}" class="aix-deposit-hash-back">&larr; Back to deposit</a>

<div class="aix-deposit-hash-panel">
    <h1>Confirm Deposit</h1>

    <div class="aix-deposit-hash-note">
        Copy and paste the transaction hash from your wallet after sending your deposit.
    </div>

    @if (session('success'))
        <div class="aix-deposit-hash-alert is-success">{{ session('success') }}</div>
        <script>
            setTimeout(function () {
                window.location.href = "{{ route('aix.exchange.assets') }}";
            }, 2000);
        </script>
    @endif

    @if (session('error'))
        <div class="aix-deposit-hash-alert is-error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('aix.exchange.deposit.transaction-hash.process') }}" method="POST" id="deposit-form">
        @csrf

        @if ($coinSymbol)
            <input type="hidden" name="coin" value="{{ $coinSymbol }}">
        @endif

        <div class="aix-deposit-hash-field">
            <label for="transaction_hash">Transaction Hash</label>
            <input
                class="aix-deposit-hash-input"
                id="transaction_hash"
                name="transaction_hash"
                type="text"
                placeholder="Enter transaction hash"
                value="{{ old('transaction_hash') }}"
                required
                autofocus
            >
        </div>

        <div class="aix-deposit-hash-field">
            <label for="amount">Deposit value (USD)</label>
            <input
                class="aix-deposit-hash-input"
                id="amount"
                name="amount"
                type="number"
                step="0.01"
                min="0.01"
                placeholder="Enter USD value you deposited"
                value="{{ old('amount') }}"
                required
            >
            <small style="color: #94a3b8; display: block; margin-top: 8px;">
                Enter the USD value of your AIX deposit. Your AIX units are calculated automatically when admin approves.
            </small>
        </div>

        <button type="submit" class="aix-deposit-hash-btn" id="submit-button">
            <span class="aix-deposit-hash-spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="button-text">Submit</span>
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('deposit-form');
    var submitButton = document.getElementById('submit-button');
    var buttonText = submitButton.querySelector('.button-text');

    form.addEventListener('submit', function () {
        submitButton.disabled = true;
        submitButton.classList.add('is-loading');
        buttonText.textContent = 'Processing...';
    });
});
</script>
@endsection
