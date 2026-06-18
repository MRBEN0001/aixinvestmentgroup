<?php

namespace App\Filament\Widgets;

use App\Models\Investment;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Table\Columns\TextColumn;

class PendingInvestments extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Investment::with('user', 'companyWallet')->where('status', investmentStatuses()['pending']);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')->label('time'),
            Tables\Columns\TextColumn::make('user.name'),
            Tables\Columns\TextColumn::make('companyWallet.coin'),
            Tables\Columns\TextColumn::make('amount'),
            Tables\Columns\TextColumn::make('roi'),
            Tables\Columns\TextColumn::make('status'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
