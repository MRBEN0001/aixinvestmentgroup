<?php

use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestTransactions extends BaseWidget
{

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Transaction::query()->latest()->limit(6)
            )
            ->columns([
                TextColumn::make('user.name')->label('User')->searchable(),
                TextColumn::make('transaction_type')->label('Type')->badge(),
                TextColumn::make('amount')->money('usd', true)->label('Amount'),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('created_at')->label('Date')->since(),
            ]);
    }
}
