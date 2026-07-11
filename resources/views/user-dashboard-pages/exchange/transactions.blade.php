@extends('layouts.aix-exchange')
@section('content')
<style>
    :root {
        --aix-border: rgba(176, 131, 97, 0.35);
        --aix-gold: #b08361;
        --aix-gold-light: #c9aa79;
        --aix-muted: #94a3b8;
        --aix-text: #f8fafc;
    }

    .aix-tx-hero {
        margin-bottom: 20px;
    }

    .aix-tx-hero h1 {
        color: #fff;
        font-size: 1.75rem;
        margin-bottom: 8px;
    }

    .aix-tx-hero p {
        color: var(--aix-muted);
        margin: 0;
    }

    .aix-tx-filters {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        margin-bottom: 18px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 4px;
    }

    .aix-tx-filter {
        background: transparent;
        border: 1px solid var(--aix-border);
        border-radius: 999px;
        color: var(--aix-gold-light);
        flex-shrink: 0;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 14px;
        text-decoration: none;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .aix-tx-filter:hover,
    .aix-tx-filter.is-active {
        background: rgba(176, 131, 97, 0.16);
        color: #fff;
        text-decoration: none;
    }

    .aix-tx-panel {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        overflow: hidden;
    }

    .aix-tx-list {
        display: flex;
        flex-direction: column;
    }

    .aix-tx-row {
        align-items: flex-start;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        display: grid;
        gap: 12px 16px;
        grid-template-columns: 120px 1fr auto;
        padding: 16px 20px;
    }

    .aix-tx-row:last-child {
        border-bottom: 0;
    }

    .aix-tx-type-wrap {
        min-width: 0;
    }

    .aix-tx-type {
        border-radius: 999px;
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.4px;
        padding: 5px 10px;
        text-transform: uppercase;
    }

    .aix-tx-type.is-deposit {
        background: rgba(32, 165, 94, 0.16);
        color: #86efac;
    }

    .aix-tx-type.is-trade {
        background: rgba(176, 131, 97, 0.18);
        color: #c9aa79;
    }

    .aix-tx-type.is-withdrawal {
        background: rgba(239, 68, 68, 0.16);
        color: #fca5a5;
    }

    .aix-tx-type.is-transfer,
    .aix-tx-type.is-purchase {
        background: rgba(59, 130, 246, 0.16);
        color: #93c5fd;
    }

    .aix-tx-date {
        color: var(--aix-muted);
        display: block;
        font-size: 11px;
        line-height: 1.3;
        margin-top: 6px;
    }

    .aix-tx-details {
        color: #fff;
        font-size: 14px;
        line-height: 1.45;
        min-width: 0;
        word-break: break-word;
    }

    .aix-tx-flow {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .aix-tx-flow-out {
        color: #fca5a5;
        font-size: 13px;
        font-weight: 600;
    }

    .aix-tx-flow-in {
        color: #86efac;
        font-size: 13px;
        font-weight: 600;
    }

    .aix-tx-units {
        font-size: 13px;
        font-weight: 600;
    }

    .aix-tx-units.is-in {
        color: #86efac;
    }

    .aix-tx-units.is-out {
        color: #fca5a5;
    }

    .aix-tx-usd {
        color: var(--aix-muted);
        font-size: 12px;
        font-weight: 500;
    }

    .aix-tx-fee-note {
        color: var(--aix-muted);
        font-size: 11px;
        margin-top: 2px;
    }

    .aix-tx-status {
        font-size: 12px;
        font-weight: 600;
        text-align: right;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .aix-tx-status.is-success {
        color: #86efac;
    }

    .aix-tx-status.is-pending {
        color: #fbbf24;
    }

    .aix-tx-status.is-cancelled,
    .aix-tx-status.is-declined {
        color: #fca5a5;
    }

    .aix-tx-empty {
        color: var(--aix-muted);
        padding: 40px 20px;
        text-align: center;
    }

    .aix-tx-pagination {
        padding: 16px 20px;
    }

    .aix-tx-pagination nav {
        display: flex;
        justify-content: center;
    }

    @media (max-width: 767px) {
        .aix-tx-hero h1 {
            font-size: 1.4rem;
        }

        .aix-tx-row {
            grid-template-columns: 1fr auto;
            grid-template-areas:
                "type status"
                "details details";
            padding: 14px 14px;
        }

        .aix-tx-type-wrap {
            grid-area: type;
        }

        .aix-tx-details {
            grid-area: details;
            font-size: 13px;
        }

        .aix-tx-status {
            grid-area: status;
        }

        .aix-tx-panel {
            border-radius: 14px;
        }
    }
</style>

@php
    $formatTxDescription = function ($tx): array {
        $raw = trim((string) ($tx->description ?? ''));
        $clean = trim(preg_replace('/\s*\(rate[^)]*\)/i', '', $raw) ?? $raw);
        $type = $tx->transaction_type;

        if (preg_match('/Out:\s*([^\·]+)\s*·\s*In:\s*(.+)$/iu', $clean, $m)) {
            return [
                'mode' => 'trade',
                'out' => trim($m[1]),
                'in' => trim($m[2]),
            ];
        }

        if (preg_match('/Traded\s+([^\→]+)\s*→\s*(.+)$/iu', $clean, $m)) {
            return [
                'mode' => 'trade',
                'out' => trim($m[1]),
                'in' => trim($m[2]),
            ];
        }

        if (in_array($type, ['deposit', 'withdrawal'], true)) {
            if (preg_match('/^(.+?)\s*·\s*(\$[\d,\.]+)/u', $clean, $m)) {
                return [
                    'mode' => 'asset',
                    'units' => trim($m[1]),
                    'usd' => trim($m[2]),
                    'tone' => $type === 'deposit' ? 'in' : 'out',
                ];
            }

            return [
                'mode' => 'asset',
                'units' => $type === 'deposit' ? 'AIX' : '—',
                'usd' => '$' . number_format((float) $tx->amount, 2),
                'tone' => $type === 'deposit' ? 'in' : 'out',
            ];
        }

        return [
            'mode' => 'text',
            'text' => $clean !== '' ? $clean : '—',
        ];
    };
@endphp

<div class="aix-tx-hero">
    <h1>Transactions</h1>
    <p>All exchange activity — deposits, trades, withdrawals, and more.</p>
</div>

@if (session('success'))
    <div style="background:rgba(32,165,94,0.15);border:1px solid rgba(32,165,94,0.4);border-radius:12px;color:#86efac;font-size:14px;margin-bottom:16px;padding:12px 14px;">
        {{ session('success') }}
    </div>
@endif

<div class="aix-tx-filters">
    <a href="{{ route('aix.exchange.transactions') }}" class="aix-tx-filter {{ ! $activeType ? 'is-active' : '' }}">All</a>
    <a href="{{ route('aix.exchange.transactions', ['type' => 'deposit']) }}" class="aix-tx-filter {{ $activeType === 'deposit' ? 'is-active' : '' }}">Deposit</a>
    <a href="{{ route('aix.exchange.transactions', ['type' => 'trade']) }}" class="aix-tx-filter {{ $activeType === 'trade' ? 'is-active' : '' }}">Trade</a>
    <a href="{{ route('aix.exchange.transactions', ['type' => 'withdrawal']) }}" class="aix-tx-filter {{ $activeType === 'withdrawal' ? 'is-active' : '' }}">Withdrawal</a>
</div>

<div class="aix-tx-panel">
    @if ($transactions->count())
        <div class="aix-tx-list">
            @foreach ($transactions as $tx)
                @php
                    $parsed = $formatTxDescription($tx);
                @endphp
                <div class="aix-tx-row">
                    <div class="aix-tx-type-wrap">
                        <span class="aix-tx-type is-{{ $tx->transaction_type }}">{{ $tx->transaction_type }}</span>
                        <span class="aix-tx-date">{{ $tx->created_at?->format('M j, Y · H:i') }}</span>
                    </div>

                    <div class="aix-tx-details">
                        @if ($parsed['mode'] === 'trade')
                            <div class="aix-tx-flow">
                                <span class="aix-tx-flow-out">Out: {{ $parsed['out'] }}</span>
                                <span class="aix-tx-flow-in">In: {{ $parsed['in'] }}</span>
                                <span class="aix-tx-fee-note">In amount is after 0.10% fee</span>
                            </div>
                        @elseif ($parsed['mode'] === 'asset')
                            <div class="aix-tx-flow">
                                <span class="aix-tx-units is-{{ $parsed['tone'] }}">{{ $parsed['units'] }}</span>
                                <span class="aix-tx-usd">{{ $parsed['usd'] }}</span>
                            </div>
                        @else
                            {{ $parsed['text'] }}
                        @endif
                    </div>

                    <div class="aix-tx-status is-{{ $tx->status === 'cancelled' ? 'declined' : $tx->status }}">
                        {{ $tx->status === 'cancelled' ? 'declined' : $tx->status }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="aix-tx-pagination">
            {{ $transactions->withQueryString()->links() }}
        </div>
    @else
        <div class="aix-tx-empty">
            No {{ $activeType ? $activeType : 'exchange' }} transactions yet.
        </div>
    @endif
</div>
@endsection
