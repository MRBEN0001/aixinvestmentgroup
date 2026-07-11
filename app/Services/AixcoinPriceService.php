<?php

namespace App\Services;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class AixcoinPriceService
{
    private const PRICE_KEY = 'aixcoin_price';

    private const HISTORY_KEY = 'aixcoin_price_history';

    public function current(): float
    {
        $setting = Setting::firstOrCreate(
            ['key' => self::PRICE_KEY],
            ['value' => '0.5']
        );

        return (float) $setting->value;
    }

    public function recordChange(float $newPrice): void
    {
        $newPrice = max(0, round($newPrice, 4));
        $previous = $this->current();

        Setting::updateOrCreate(
            ['key' => self::PRICE_KEY],
            ['value' => (string) $newPrice]
        );

        if (abs($previous - $newPrice) >= 0.0001) {
            $history = $this->history();
            $history[] = [
                'price' => $newPrice,
                'previous' => $previous,
                'changed_at' => now()->toIso8601String(),
            ];

            Setting::updateOrCreate(
                ['key' => self::HISTORY_KEY],
                ['value' => json_encode(array_slice($history, -50))]
            );
        }

        $this->clearChartCache();
    }

    public function history(): array
    {
        $raw = Setting::where('key', self::HISTORY_KEY)->value('value');

        if (! $raw) {
            $price = $this->current();

            return [[
                'price' => $price,
                'previous' => $price,
                'changed_at' => now()->subDays(7)->toIso8601String(),
            ]];
        }

        $history = json_decode($raw, true);

        return is_array($history) ? $history : [];
    }

    public function change24h(): float
    {
        $current = $this->current();
        $oldPrice = $this->priceAt(now()->subDay());

        if ($oldPrice <= 0) {
            return 0;
        }

        return (($current - $oldPrice) / $oldPrice) * 100;
    }

    public function chartData(int $days = 7): array
    {
        $current = $this->current();
        $history = $this->sortedHistory();
        $end = now();
        $start = now()->subDays($days);
        $startPrice = $this->priceAt($start);

        $anchors = collect([
            ['time' => $start->copy(), 'price' => $startPrice],
        ]);

        foreach ($history as $entry) {
            if (! $entry['time']->between($start, $end)) {
                continue;
            }

            $previous = (float) ($entry['previous'] ?? $startPrice);
            $leadIn = $entry['time']->copy()->subHours(max(6, intdiv($days * 24, 6)));

            if ($leadIn->gt($start)) {
                $anchors->push(['time' => $leadIn, 'price' => $previous]);
            }

            $anchors->push(['time' => $entry['time']->copy(), 'price' => (float) $entry['price']]);
        }

        $anchors->push(['time' => $end->copy(), 'price' => $current]);
        $anchors = $anchors
            ->sortBy(fn (array $anchor) => $anchor['time']->timestamp)
            ->values();

        $points = max(48, $days * 12);
        $labels = [];
        $prices = [];
        $stepHours = max(1, ($days * 24) / $points);

        for ($i = $points; $i >= 0; $i--) {
            $time = $end->copy()->subHours($i * $stepHours);
            $price = $this->interpolatePrice($anchors, $time);

            if ($i > 0) {
                $noise = (mt_rand(-8, 8) / 10000) * max($price, 0.01);
                $price = max(0.01, $price + $noise);
            } else {
                $price = $current;
            }

            $labels[] = $time->format('M j, H:i');
            $prices[] = round($price, 4);
        }

        return [
            'labels' => $labels,
            'prices' => $prices,
            'trendUp' => $current >= $startPrice,
            'periodChange' => $startPrice > 0 ? (($current - $startPrice) / $startPrice) * 100 : 0,
        ];
    }

    public function priceAt(Carbon $moment): float
    {
        $history = $this->sortedHistory();

        $upcoming = $history->first(fn (array $entry) => $entry['time']->gt($moment));
        if ($upcoming) {
            return (float) ($upcoming['previous'] ?? $upcoming['price']);
        }

        $passed = $history->filter(fn (array $entry) => $entry['time']->lte($moment))->last();
        if ($passed) {
            return (float) $passed['price'];
        }

        return $this->current();
    }

    private function sortedHistory(): Collection
    {
        return collect($this->history())
            ->map(fn (array $entry) => [
                'price' => (float) $entry['price'],
                'previous' => (float) ($entry['previous'] ?? $entry['price']),
                'time' => Carbon::parse($entry['changed_at']),
            ])
            ->sortBy('time')
            ->values();
    }

    private function interpolatePrice(Collection $anchors, Carbon $moment): float
    {
        if ($anchors->isEmpty()) {
            return $this->current();
        }

        if ($moment->lte($anchors->first()['time'])) {
            return (float) $anchors->first()['price'];
        }

        if ($moment->gte($anchors->last()['time'])) {
            return (float) $anchors->last()['price'];
        }

        for ($i = 0; $i < $anchors->count() - 1; $i++) {
            $from = $anchors[$i];
            $to = $anchors[$i + 1];

            if ($moment->between($from['time'], $to['time'])) {
                $total = max(1, $from['time']->diffInSeconds($to['time']));
                $elapsed = $from['time']->diffInSeconds($moment);
                $ratio = min(1, max(0, $elapsed / $total));

                return (float) $from['price'] + (($to['price'] - $from['price']) * $ratio);
            }
        }

        return (float) $anchors->last()['price'];
    }

    private function clearChartCache(): void
    {
        foreach ([7, 14, 30, 90] as $days) {
            Cache::forget("aix_exchange_chart_AIX_{$days}");
        }
    }
}
