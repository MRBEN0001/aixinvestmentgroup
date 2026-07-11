@extends('layouts.aix-exchange')
@section('content')
<style>
    .aix-assets-panel {
        background: #121821 !important;
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 18px;
        overflow: hidden;
    }

    .aix-assets-table {
        --bs-table-bg: transparent;
        --bs-table-color: #f8fafc;
        --bs-table-border-color: rgba(255, 255, 255, 0.08);
        --bs-table-hover-bg: rgba(255, 255, 255, 0.03);
        background-color: transparent !important;
        color: #f8fafc;
        margin: 0;
        width: 100%;
    }

    .aix-assets-table > :not(caption) > * > * {
        background-color: transparent !important;
        box-shadow: none !important;
    }

    .aix-assets-table tbody td {
        border-color: rgba(255, 255, 255, 0.08);
        padding: 18px 24px;
        vertical-align: middle;
    }

    .aix-assets-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    .aix-assets-table tbody tr.is-featured {
        background: linear-gradient(90deg, rgba(176, 131, 97, 0.14), rgba(176, 131, 97, 0.03));
    }

    .aix-asset-cell {
        align-items: center;
        display: flex;
        gap: 12px;
    }

    .aix-asset-icon {
        align-items: center;
        background: #171f2b;
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 50%;
        color: #c9aa79;
        display: flex;
        font-size: 11px;
        font-weight: 700;
        height: 38px;
        justify-content: center;
        width: 38px;
    }

    .aix-asset-icon.is-featured {
        background: linear-gradient(135deg, #b08361, #8f6648);
        color: #fff;
    }

    .aix-asset-logo {
        border-radius: 50%;
        flex-shrink: 0;
        height: 38px;
        object-fit: cover;
        width: 38px;
    }

    .aix-asset-name {
        color: #fff;
        display: block;
        font-weight: 600;
    }

    .aix-asset-symbol {
        color: #94a3b8;
        font-size: 12px;
    }

    .aix-asset-balance {
        color: #fff;
        font-weight: 600;
        text-align: right;
        white-space: nowrap;
    }

    .aix-asset-balance.is-empty {
        color: #64748b;
    }

    .aix-asset-value {
        color: #94a3b8;
        display: block;
        font-size: 12px;
        font-weight: 500;
        margin-top: 4px;
    }

    @media (max-width: 767px) {
        .aix-assets-table tbody td {
            padding: 14px 16px;
        }
    }
    .aix-assets-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 24px;
    }

    .aix-assets-stat {
        background: #121821 !important;
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 14px;
        flex: 1 1 220px;
        min-width: 220px;
        padding: 18px 20px;
    }

    .aix-assets-stat span {
        color: #94a3b8;
        display: block;
        font-size: 12px;
        letter-spacing: 1px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-assets-stat strong {
        color: #fff;
        font-size: 1.35rem;
    }

    .aix-assets-btn {
        align-items: center;
        border-radius: 12px;
        display: inline-flex;
        flex: 1 1 160px;
        font-size: 13px;
        font-weight: 700;
        justify-content: center;
        letter-spacing: 0.5px;
        min-width: 140px;
        padding: 14px 20px;
        text-decoration: none;
        text-transform: uppercase;
        transition: opacity 0.2s ease;
    }

    .aix-assets-btn:hover {
        color: inherit;
        opacity: 0.9;
        text-decoration: none;
    }

    .aix-assets-btn-deposit {
        background: linear-gradient(135deg, #b08361, #8f6648);
        border: 1px solid rgba(176, 131, 97, 0.5);
        color: #fff;
    }

    .aix-assets-btn-withdraw {
        background: transparent;
        border: 1px solid rgba(176, 131, 97, 0.5);
        color: #c9aa79;
    }

    .aix-assets-top {
        display: grid;
        gap: 16px;
        grid-template-columns: 1fr auto;
        margin-bottom: 24px;
    }

    @media (max-width: 767px) {
        .aix-assets-top {
            grid-template-columns: 1fr;
        }

        .aix-assets-actions {
            width: 100%;
        }

        .aix-assets-btn {
            flex: 1 1 100%;
        }
    }
</style>

<div class="aix-assets-top">
    <div class="aix-assets-stat">
        <span>Total Value</span>
        <strong>${{ number_format($totalValue, 2) }}</strong>
    </div>

    <div class="aix-assets-actions">
        <a href="{{ route('aix.exchange.deposit') }}" class="aix-assets-btn aix-assets-btn-deposit">Deposit</a>
        <a href="{{ route('aix.exchange.withdrawal') }}" class="aix-assets-btn aix-assets-btn-withdraw">Withdrawal</a>
    </div>
</div>

<div class="aix-assets-panel">
    <table class="table aix-assets-table">
        <tbody>
            @foreach ($assets as $asset)
                <tr class="{{ $asset['highlight'] ? 'is-featured' : '' }}">
                    <td>
                        <div class="aix-asset-cell">
                            @if ($asset['highlight'])
                                <div class="aix-asset-icon is-featured">{{ $asset['symbol'] }}</div>
                            @else
                                <img src="{{ $asset['logo'] }}" alt="{{ $asset['name'] }}" class="aix-asset-logo" loading="lazy">
                            @endif
                            <div>
                                <span class="aix-asset-name">{{ $asset['name'] }}</span>
                                <span class="aix-asset-symbol">{{ $asset['symbol'] }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="aix-asset-balance {{ $asset['balance'] > 0 ? '' : 'is-empty' }}">
                        {{ rtrim(rtrim(number_format($asset['balance'], 8), '0'), '.') }} {{ $asset['symbol'] }}
                        @if ($asset['balance'] > 0)
                            <span class="aix-asset-value">${{ number_format($asset['value_usd'], 2) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
