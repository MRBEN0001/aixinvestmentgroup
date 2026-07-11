<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeDepositResource\Pages;
use App\Models\Deposit;
use App\Services\ExchangeMailService;
use App\Services\ExchangeMarketService;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ExchangeDepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationGroup = 'Aix Exchange';

    protected static ?string $navigationLabel = 'Exchange Deposits';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Exchange Deposit';

    protected static ?string $pluralModelLabel = 'Exchange Deposits';

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
                Tables\Columns\TextColumn::make('companyWallet.coin')->label('Coin')->default('Aixcoin'),
                Tables\Columns\TextColumn::make('amount')
                    ->label('USD Deposited')
                    ->money('usd'),
                Tables\Columns\TextColumn::make('credited_units')
                    ->label('AIX Credited')
                    ->formatStateUsing(fn ($state) => $state ? number_format((float) $state, 4) . ' AIX' : '—'),
                Tables\Columns\TextColumn::make('reference')->label('Transaction Hash')->limit(24),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
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
                    ->label(fn ($record) => $record->status === 'approved' ? 'Confirmed' : ($record->status === 'declined' ? 'Declined' : 'Approve / Decline'))
                    ->color(fn ($record) => $record->status === 'approved' ? 'success' : ($record->status === 'declined' ? 'danger' : 'primary'))
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
                        $newStatus = $data['status'];
                        $previousStatus = $record->status;

                        if ($newStatus === 'approved' && $previousStatus !== 'approved') {
                            $record->loadMissing('user', 'companyWallet');
                            $credited = $market->creditApprovedDeposit($record);

                            if (! $credited && ! $record->balance_credited) {
                                Notification::make()
                                    ->title('Deposit approved but balance could not be credited')
                                    ->danger()
                                    ->send();

                                return;
                            }
                        }

                        if ($newStatus === 'approved' && $previousStatus === 'approved' && ! $record->balance_credited) {
                            $record->loadMissing('user', 'companyWallet');
                            $market->creditApprovedDeposit($record->fresh());
                        }

                        if ($newStatus === 'declined' && $previousStatus !== 'declined') {
                            $record->loadMissing('user', 'companyWallet');
                            $market->declineExchangeDeposit($record);
                            $record->refresh();
                        } else {
                            $record->update(['status' => $newStatus]);
                        }

                        $record->refresh();

                        try {
                            $mail = app(ExchangeMailService::class);
                            $amountLabel = $market->depositAmountLabel($record);

                            if ($newStatus === 'approved') {
                                $mail->notifyTransaction($record->user, [
                                    'type' => 'deposit',
                                    'title' => 'Deposit Approved',
                                    'subject' => 'AIX Exchange Deposit Approved',
                                    'message' => 'Your Aixcoin deposit has been approved and credited to your exchange wallet.',
                                    'amount_label' => $amountLabel,
                                    'status' => 'approved',
                                    'reference' => $record->reference,
                                    'reference_label' => 'Transaction Hash',
                                ]);
                            } elseif ($newStatus === 'declined') {
                                $mail->notifyTransaction($record->user, [
                                    'type' => 'deposit',
                                    'title' => 'Deposit Declined',
                                    'subject' => 'AIX Exchange Deposit Declined',
                                    'message' => 'Your Aixcoin deposit was declined. Please contact support if you need help.',
                                    'amount_label' => $amountLabel,
                                    'status' => 'declined',
                                    'reference' => $record->reference,
                                    'reference_label' => 'Transaction Hash',
                                ]);
                            }

                            Notification::make()
                                ->title($newStatus === 'approved'
                                    ? 'Exchange deposit approved and balance credited'
                                    : 'Exchange deposit declined')
                                ->success()
                                ->send();
                        } catch (\Throwable $error) {
                            Log::error('Exchange deposit notification failed: ' . $error->getMessage());

                            Notification::make()
                                ->title('Status updated, but email could not be sent')
                                ->warning()
                                ->send();
                        }
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchangeDeposits::route('/'),
        ];
    }
}
