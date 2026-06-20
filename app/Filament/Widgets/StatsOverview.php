<?php

namespace App\Filament\Widgets;

use App\Models\Investment;
use App\Models\Withdrawal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make(
                'No Of Investments This Month',
                Investment::where('created_at', '>', now()->subDays(30))->count()
            ),
            Card::make(
                'No Of Withdrawals This Month',
                Withdrawal::where('created_at', '>', now()->subDays(30))->count()
            )
        ];
    }
}
