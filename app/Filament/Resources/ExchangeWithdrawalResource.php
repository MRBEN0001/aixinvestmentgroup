<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeWithdrawalResource\Pages;
use App\Models\Withdrawal;
use App\Services\ExchangeMarketService;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExchangeWithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static ?string $navigationGroup = 'Aix Exchange';

    protected static ?string $navigationLabel = 'Exchange Withdrawals';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Exchange Withdrawal';

    protected static ?string $pluralModelLabel = 'Exchange Withdrawals';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('source', 'exchange')
            ->with(['user', 'companyWallet']);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User')->searchable(),
                Tables\Columns\TextColumn::make('user.email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('companyWallet.coin')->label('Coin'),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Units')
                    ->formatStateUsing(fn ($state, Withdrawal $record) => number_format((float) $state, 8) . ' ' . strtoupper($record->companyWallet?->abbr ?? '')),
                Tables\Columns\TextColumn::make('usd_value')
                    ->label('USD Value')
                    ->money('usd'),
                Tables\Columns\TextColumn::make('wallet_address')
                    ->label('Wallet Address')
                    ->limit(28)
                    ->copyable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'approved' => 'success',
                        'declined' => 'danger',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'declined' => 'Declined',
                    ]),
            ])
            ->actions([
                Action::make('changeStatus')
                    ->label(fn ($record) => strtolower($record->status) === 'approved'
                        ? 'Approved'
                        : (strtolower($record->status) === 'declined' ? 'Declined' : 'Approve / Decline'))
                    ->color(fn ($record) => strtolower($record->status) === 'approved'
                        ? 'success'
                        : (strtolower($record->status) === 'declined' ? 'danger' : 'primary'))
                    ->disabled(fn ($record) => in_array(strtolower($record->status), ['approved', 'declined'], true))
                    ->form([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'approved' => 'Approve',
                                'declined' => 'Decline',
                            ])
                            ->required(),
                    ])
                    ->action(function ($record, array $data, ExchangeMarketService $market) {
                        $result = $market->processWithdrawalStatus($record, $data['status']);

                        $notification = Notification::make()->title($result['message']);

                        if ($result['success']) {
                            $notification->success();
                        } else {
                            $notification->danger();
                        }

                        $notification->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchangeWithdrawals::route('/'),
        ];
    }
}
