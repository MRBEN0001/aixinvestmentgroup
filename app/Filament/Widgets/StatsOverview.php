<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count()),

            Stat::make('Total Withdrawals', Transaction::where('transaction_type', 'withdrawal')->count()),

            Stat::make('Total Transactions', Transaction::count()),
        ];
    }
}
