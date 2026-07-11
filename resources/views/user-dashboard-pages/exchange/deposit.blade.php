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

    .aix-deposit-hero {
        margin-bottom: 24px;
    }

    .aix-deposit-hero h1 {
        color: #fff;
        font-size: 1.75rem;
        margin-bottom: 8px;
    }

    .aix-deposit-hero p {
        color: var(--aix-muted);
        margin: 0;
        max-width: 560px;
    }

    .aix-deposit-panel {
        background: #121821 !important;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        overflow: hidden;
    }

    .aix-deposit-panel-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 18px 22px;
    }

    .aix-deposit-panel-header h5 {
        color: #fff;
        margin: 0 0 14px;
    }

    .aix-deposit-search {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        padding: 10px 14px;
        width: 100%;
    }

    .aix-deposit-search:focus {
        border-color: var(--aix-gold);
        box-shadow: none;
        outline: none;
    }

    .aix-deposit-search::placeholder {
        color: #64748b;
    }

    .aix-deposit-list {
        max-height: 520px;
        overflow-y: auto;
    }

    .aix-deposit-item {
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        color: inherit;
        display: flex;
        gap: 14px;
        padding: 16px 22px;
        text-decoration: none;
        transition: background 0.2s ease;
    }

    .aix-deposit-item:last-child {
        border-bottom: 0;
    }

    .aix-deposit-item:hover {
        background: rgba(176, 131, 97, 0.08);
        color: inherit;
        text-decoration: none;
    }

    .aix-deposit-item.is-featured {
        background: linear-gradient(90deg, rgba(176, 131, 97, 0.18), rgba(176, 131, 97, 0.04));
    }

    .aix-deposit-item.is-hidden {
        display: none;
    }

    .aix-deposit-icon {
        align-items: center;
        background: var(--aix-panel-soft);
        border: 1px solid var(--aix-border);
        border-radius: 50%;
        color: var(--aix-gold-light);
        display: flex;
        flex-shrink: 0;
        font-size: 11px;
        font-weight: 700;
        height: 42px;
        justify-content: center;
        width: 42px;
    }

    .aix-deposit-icon.is-featured {
        background: linear-gradient(135deg, #b08361, #8f6648);
        color: #fff;
    }

    .aix-deposit-logo {
        border-radius: 50%;
        flex-shrink: 0;
        height: 42px;
        object-fit: cover;
        width: 42px;
    }

    .aix-deposit-meta {
        flex: 1;
        min-width: 0;
    }

    .aix-deposit-name {
        color: #fff;
        display: block;
        font-weight: 600;
    }

    .aix-deposit-symbol {
        color: var(--aix-muted);
        font-size: 13px;
    }

    .aix-deposit-tag {
        background: rgba(176, 131, 97, 0.16);
        border: 1px solid var(--aix-border);
        border-radius: 999px;
        color: var(--aix-gold-light);
        font-size: 11px;
        padding: 4px 10px;
        white-space: nowrap;
    }

    .aix-deposit-empty {
        color: var(--aix-muted);
        display: none;
        padding: 32px 22px;
        text-align: center;
    }

    .aix-deposit-empty.is-visible {
        display: block;
    }

    .aix-deposit-item.is-locked {
        background: transparent;
        border: 0;
        cursor: pointer;
        text-align: left;
        width: 100%;
    }

    .aix-deposit-modal {
        align-items: center;
        background: rgba(0, 0, 0, 0.72);
        display: none;
        inset: 0;
        justify-content: center;
        padding: 20px;
        position: fixed;
        z-index: 1050;
    }

    .aix-deposit-modal.is-open {
        display: flex;
    }

    .aix-deposit-modal-card {
        background: #121821;
        border: 1px solid var(--aix-border);
        border-radius: 18px;
        max-width: 460px;
        padding: 28px;
        width: 100%;
    }

    .aix-deposit-modal-card h3 {
        color: #fff;
        font-size: 1.25rem;
        margin-bottom: 12px;
    }

    .aix-deposit-modal-card p {
        color: var(--aix-muted);
        margin-bottom: 20px;
    }

    .aix-deposit-modal-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .aix-deposit-modal-btn {
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        padding: 12px 18px;
        text-decoration: none;
        text-transform: uppercase;
    }

    .aix-deposit-modal-btn-primary {
        background: linear-gradient(135deg, #b08361, #8f6648);
        color: #fff;
    }

    .aix-deposit-modal-btn-secondary {
        background: transparent;
        border: 1px solid var(--aix-border);
        color: var(--aix-gold-light);
    }

    .aix-deposit-flash {
        background: rgba(194, 52, 52, 0.15);
        border: 1px solid rgba(194, 52, 52, 0.4);
        border-radius: 12px;
        color: #fca5a5;
        margin-bottom: 20px;
        padding: 12px 16px;
    }
</style>

<div class="aix-deposit-hero">
    <h1>Deposit</h1>
    <p>Only Aixcoin (AIX) can be deposited directly. To hold other assets, deposit AIX and use Quick Trade on the exchange home page.</p>
</div>

@if (session('error'))
    <div class="aix-deposit-flash">{{ session('error') }}</div>
@endif

<div class="aix-deposit-panel">
    <div class="aix-deposit-panel-header">
        <h5>Select Coin</h5>
        <input
            type="search"
            id="deposit-coin-search"
            class="aix-deposit-search"
            placeholder="Search coins..."
            autocomplete="off"
        >
    </div>

    <div class="aix-deposit-list" id="deposit-coin-list">
        @foreach ($coins as $coin)
            @if ($coin['highlight'])
                <a
                    href="{{ route('aix.exchange.deposit.coin', $coin['symbol']) }}"
                    class="aix-deposit-item is-featured"
                    data-name="{{ strtolower($coin['name']) }}"
                    data-symbol="{{ strtolower($coin['symbol']) }}"
                >
                    <div class="aix-deposit-icon is-featured">{{ $coin['symbol'] }}</div>

                    <div class="aix-deposit-meta">
                        <span class="aix-deposit-name">{{ $coin['name'] }}</span>
                        <span class="aix-deposit-symbol">{{ $coin['symbol'] }}</span>
                    </div>

                    <span class="aix-deposit-tag">Deposit Accepted</span>
                </a>
            @else
                <button
                    type="button"
                    class="aix-deposit-item is-locked"
                    data-name="{{ strtolower($coin['name']) }}"
                    data-symbol="{{ strtolower($coin['symbol']) }}"
                    data-coin-name="{{ $coin['name'] }}"
                    onclick="openDepositModal('{{ $coin['name'] }}', '{{ $coin['symbol'] }}')"
                >
                    <img src="{{ $coin['logo'] }}" alt="{{ $coin['name'] }}" class="aix-deposit-logo" loading="lazy">

                    <div class="aix-deposit-meta">
                        <span class="aix-deposit-name">{{ $coin['name'] }}</span>
                        <span class="aix-deposit-symbol">{{ $coin['symbol'] }}</span>
                    </div>
                </button>
            @endif
        @endforeach

        <div class="aix-deposit-empty" id="deposit-coin-empty">
            No coins match your search.
        </div>
    </div>
</div>

<div class="aix-deposit-modal" id="deposit-info-modal" onclick="closeDepositModal(event)">
    <div class="aix-deposit-modal-card" onclick="event.stopPropagation()">
        <h3 id="deposit-modal-title">Deposit via Aixcoin</h3>
        <p id="deposit-modal-text">
            This exchange only accepts Aixcoin (AIX) deposits. Deposit AIX, then trade for the coin you want on Quick Trade.
        </p>
        <div class="aix-deposit-modal-actions">
            <a href="{{ route('aix.exchange.deposit.coin', 'AIX') }}" class="aix-deposit-modal-btn aix-deposit-modal-btn-primary">Deposit AIX</a>
            <a href="{{ route('aix.exchange') }}" class="aix-deposit-modal-btn aix-deposit-modal-btn-secondary">Go to Quick Trade</a>
            <button type="button" class="aix-deposit-modal-btn aix-deposit-modal-btn-secondary" onclick="closeDepositModal()">Close</button>
        </div>
    </div>
</div>

<script>
function openDepositModal(coinName, coinSymbol) {
    var modal = document.getElementById('deposit-info-modal');
    var title = document.getElementById('deposit-modal-title');
    var text = document.getElementById('deposit-modal-text');

    title.textContent = 'Deposit ' + coinSymbol + ' via Aixcoin';
    text.textContent = 'Direct ' + coinName + ' (' + coinSymbol + ') deposits are not accepted. Deposit Aixcoin (AIX) first, then trade for ' + coinSymbol + ' using Quick Trade.';
    modal.classList.add('is-open');
}

function closeDepositModal(event) {
    if (event && event.target !== document.getElementById('deposit-info-modal')) {
        return;
    }

    document.getElementById('deposit-info-modal').classList.remove('is-open');
}

(function () {
    var searchInput = document.getElementById('deposit-coin-search');
    var items = Array.prototype.slice.call(document.querySelectorAll('.aix-deposit-item, .aix-deposit-item.is-locked'));
    var emptyState = document.getElementById('deposit-coin-empty');

    function filterCoins() {
        var query = searchInput.value.trim().toLowerCase();
        var visibleCount = 0;

        items.forEach(function (item) {
            var matches = !query
                || item.dataset.name.indexOf(query) !== -1
                || item.dataset.symbol.indexOf(query) !== -1;

            item.classList.toggle('is-hidden', !matches);

            if (matches) {
                visibleCount++;
            }
        });

        emptyState.classList.toggle('is-visible', visibleCount === 0);
    }

    searchInput.addEventListener('input', filterCoins);
})();
</script>
@endsection
