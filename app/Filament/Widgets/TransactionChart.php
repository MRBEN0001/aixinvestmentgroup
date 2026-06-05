<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Transactions in the Last 7 Days';

    protected function getData(): array
    {
        $data = Transaction::query()
            ->where('created_at', '>=', now()->subDays(6)->startOfDay()) // 6 days ago + today = 7 days
            ->get()
            ->groupBy(fn($item) => Carbon::parse($item->created_at)->format('D')); // group by day name

        $labels = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->format('D');
            $labels[] = $day;
            $counts[] = isset($data[$day]) ? count($data[$day]) : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Transactions',
                    'data' => $counts,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.4)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }
    protected function getType(): string
    {
        return 'line';
    }
}
