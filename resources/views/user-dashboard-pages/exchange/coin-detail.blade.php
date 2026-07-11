@extends('layouts.aix-exchange')
@section('content')
<style>
    .aix-coin-detail-back {
        color: #c9aa79;
        display: inline-block;
        font-size: 14px;
        margin-bottom: 20px;
        text-decoration: none;
    }

    .aix-coin-detail-back:hover {
        color: #fff;
    }

    .aix-coin-detail-hero {
        background: linear-gradient(135deg, rgba(11, 15, 20, 0.96), rgba(18, 24, 33, 0.92));
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 18px;
        margin-bottom: 24px;
        padding: 28px;
    }

    .aix-coin-detail-hero.is-featured {
        background:
            linear-gradient(135deg, rgba(11, 15, 20, 0.96), rgba(18, 24, 33, 0.92)),
            radial-gradient(circle at top right, rgba(176, 131, 97, 0.24), transparent 42%);
    }

    .aix-coin-detail-head {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .aix-coin-detail-title-wrap {
        align-items: center;
        display: flex;
        gap: 16px;
    }

    .aix-coin-detail-icon {
        align-items: center;
        background: #171f2b;
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 50%;
        color: #c9aa79;
        display: flex;
        font-size: 14px;
        font-weight: 700;
        height: 56px;
        justify-content: center;
        width: 56px;
    }

    .aix-coin-detail-icon.is-featured {
        background: linear-gradient(135deg, #b08361, #8f6648);
        color: #fff;
    }

    .aix-coin-detail-logo {
        border-radius: 50%;
        flex-shrink: 0;
        height: 56px;
        object-fit: cover;
        width: 56px;
    }

    .aix-coin-detail-title {
        color: #fff;
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        margin: 0;
    }

    .aix-coin-detail-symbol {
        color: #94a3b8;
        font-size: 14px;
    }

    .aix-coin-detail-price {
        color: #fff;
        font-size: clamp(1.8rem, 5vw, 2.6rem);
        font-weight: 700;
        margin: 0;
    }

    .aix-coin-detail-price.is-down {
        color: #ef4444;
    }

    .aix-coin-detail-price.is-up {
        color: #22c55e;
    }

    .aix-coin-detail-stat strong.is-up {
        color: #22c55e;
    }

    .aix-coin-detail-stat strong.is-down {
        color: #ef4444;
    }

    .aix-chart-period-change {
        font-size: 14px;
        font-weight: 600;
    }

    .aix-chart-period-change.is-up { color: #22c55e; }
    .aix-chart-period-change.is-down { color: #ef4444; }

    .aix-coin-detail-panel.chart-trend-up {
        border-color: rgba(34, 197, 94, 0.35);
    }

    .aix-coin-detail-panel.chart-trend-down {
        border-color: rgba(239, 68, 68, 0.35);
    }

    .aix-coin-detail-change {
        font-size: 15px;
        font-weight: 600;
    }

    .aix-coin-detail-change.up { color: #22c55e; }
    .aix-coin-detail-change.down { color: #ef4444; }

    .aix-coin-detail-stats {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-bottom: 24px;
    }

    .aix-coin-detail-stat {
        background: #121821 !important;
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 14px;
        padding: 18px 20px;
    }

    .aix-coin-detail-stat span {
        color: #94a3b8;
        display: block;
        font-size: 12px;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .aix-coin-detail-stat strong {
        color: #fff;
        font-size: 1.1rem;
    }

    .aix-coin-detail-panel {
        background: #121821 !important;
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 18px;
        margin-bottom: 24px;
        overflow: hidden;
        padding: 22px;
    }

    .aix-coin-detail-panel h5 {
        color: #fff;
        margin: 0 0 18px;
    }

    .aix-coin-detail-chart-wrap {
        height: 360px;
        position: relative;
    }

    .aix-coin-about-section {
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        margin-top: 18px;
        padding-top: 18px;
    }

    .aix-coin-about-section:first-child {
        border-top: 0;
        margin-top: 0;
        padding-top: 0;
    }

    .aix-coin-about-section h6 {
        color: #fff;
        margin-bottom: 10px;
    }

    .aix-coin-about-section p {
        color: #94a3b8;
        line-height: 1.8;
        margin: 0;
    }

    .aix-coin-about-section.is-highlight {
        background: linear-gradient(90deg, rgba(176, 131, 97, 0.16), rgba(176, 131, 97, 0.04));
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 14px;
        margin-top: 18px;
        padding: 18px;
    }

    .aix-coin-about-section.is-highlight h6 {
        color: #c9aa79;
    }

    .aix-feature-tag {
        background: rgba(176, 131, 97, 0.18);
        border: 1px solid rgba(176, 131, 97, 0.35);
        border-radius: 999px;
        color: #c9aa79;
        font-size: 11px;
        margin-left: 8px;
        padding: 4px 10px;
        text-transform: uppercase;
        vertical-align: middle;
    }

    @media (max-width: 991px) {
        .aix-coin-detail-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575px) {
        .aix-coin-detail-stats {
            grid-template-columns: 1fr;
        }

        .aix-coin-detail-chart-wrap {
            height: 280px;
        }
    }
</style>

@php
    $isUp = (bool) ($chart['trendUp'] ?? ($coin['change'] >= 0));
    $periodChange = $chart['periodChange'] ?? $coin['change'];
@endphp

<a href="{{ route('aix.exchange') }}" class="aix-coin-detail-back">← Back to Home</a>

<div class="aix-coin-detail-hero {{ $coin['highlight'] ? 'is-featured' : '' }}">
    <div class="aix-coin-detail-head">
        <div class="aix-coin-detail-title-wrap">
            @if ($coin['highlight'])
                <div class="aix-coin-detail-icon is-featured">{{ $coin['symbol'] }}</div>
            @else
                <img src="{{ $coin['logo'] }}" alt="{{ $coin['name'] }}" class="aix-coin-detail-logo">
            @endif
            <div>
                <h1 class="aix-coin-detail-title">
                    {{ $coin['name'] }}
                    @if ($coin['highlight'])
                        <span class="aix-feature-tag">Native Coin</span>
                    @endif
                </h1>
                <div class="aix-coin-detail-symbol">Rank #{{ $coin['rank'] }} · {{ $coin['symbol'] }}</div>
            </div>
        </div>
        <div class="text-md-end">
            <p class="aix-coin-detail-price {{ $coin['change'] >= 0 ? 'is-up' : 'is-down' }}">${{ number_format($coin['price'], $coin['price'] < 1 ? 4 : 2) }}</p>
            <div class="aix-coin-detail-change {{ $coin['change'] >= 0 ? 'up' : 'down' }}">
                {{ $coin['change'] >= 0 ? '+' : '' }}{{ number_format($coin['change'], 2) }}% (24h)
            </div>
        </div>
    </div>
</div>

<div class="aix-coin-detail-stats">
    <div class="aix-coin-detail-stat">
        <span>Market Cap</span>
        <strong>${{ formatCompactNumber($coin['market_cap']) }}</strong>
    </div>
    <div class="aix-coin-detail-stat">
        <span>24h Volume</span>
        <strong>${{ formatCompactNumber($coin['volume']) }}</strong>
    </div>
    <div class="aix-coin-detail-stat">
        <span>Price</span>
        <strong>${{ number_format($coin['price'], $coin['price'] < 1 ? 4 : 2) }}</strong>
    </div>
    <div class="aix-coin-detail-stat">
        <span>24h Change</span>
        <strong class="{{ $coin['change'] >= 0 ? 'is-up' : 'is-down' }}">
            {{ $coin['change'] >= 0 ? '+' : '' }}{{ number_format($coin['change'], 2) }}%
        </strong>
    </div>
</div>

<div class="aix-coin-detail-panel {{ $isUp ? 'chart-trend-up' : 'chart-trend-down' }}">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
    <h5 class="mb-0">Price Chart (7 Days)</h5>
    <span class="aix-chart-period-change {{ $isUp ? 'is-up' : 'is-down' }}">
        {{ $periodChange >= 0 ? '+' : '' }}{{ number_format($periodChange, 2) }}% (7d)
    </span>
  </div>
    <div class="aix-coin-detail-chart-wrap">
        <canvas id="coinPriceChart"></canvas>
    </div>
</div>

<div class="aix-coin-detail-panel">
    <h5>{{ $about['title'] }}</h5>

    @foreach ($about['sections'] as $section)
        <div class="aix-coin-about-section {{ !empty($section['highlight']) ? 'is-highlight' : '' }}">
            <h6>{{ $section['heading'] }}</h6>
            <p>{{ $section['body'] }}</p>
        </div>
    @endforeach
</div>

<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script>
(function () {
    var ctx = document.getElementById('coinPriceChart');
    if (!ctx) return;

    var labels = @json($chart['labels']);
    var prices = @json($chart['prices']);
    var isUp = @json($isUp);
    var lineColor = isUp ? '#22c55e' : '#ef4444';
    var fillColor = isUp ? 'rgba(34, 197, 94, 0.18)' : 'rgba(239, 68, 68, 0.18)';

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '{{ $coin['symbol'] }} Price (USD)',
                data: prices,
                borderColor: lineColor,
                backgroundColor: fillColor,
                borderWidth: 2,
                pointRadius: 0,
                pointHoverRadius: 4,
                fill: true,
                tension: 0.35
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: false },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: '#94a3b8',
                        maxTicksLimit: 8
                    },
                    gridLines: { color: 'rgba(255,255,255,0.06)' }
                }],
                yAxes: [{
                    ticks: {
                        fontColor: '#94a3b8',
                        callback: function (value) {
                            return '$' + Number(value).toLocaleString();
                        }
                    },
                    gridLines: { color: 'rgba(255, 255, 255, 0.06)' }
                }]
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function (tooltipItem) {
                        return '$' + Number(tooltipItem.yLabel).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 6
                        });
                    }
                }
            }
        }
    });
})();
</script>
@endsection
