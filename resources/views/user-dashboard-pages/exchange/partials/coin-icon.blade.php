@if (!empty($coin['highlight']))
    <div class="aix-coin-icon is-featured">{{ $coin['symbol'] }}</div>
@else
    <img
        src="{{ $coin['logo'] }}"
        alt="{{ $coin['name'] }}"
        class="aix-coin-logo"
        loading="lazy"
    >
@endif
