<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\CompanyWallet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class CoinsRelationManager extends RelationManager
{
    protected static string $relationship = 'coins';

    protected static ?string $recordTitleAttribute = 'wallet_address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('company_wallet_id')
                    ->label('Coin')
                    ->options(CompanyWallet::query()->pluck('coin', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('wallet_address')
                    ->default('[]')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('balance')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('companyWallet'))
            ->columns([
                Tables\Columns\TextColumn::make('companyWallet.coin')->label('Coin'),
                Tables\Columns\TextColumn::make('wallet_address')->label('Wallet address'),
                Tables\Columns\TextColumn::make('balance')
                    ->label('Balance')
                    ->money('usd'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('updateBalance')
                    ->label('Add / Remove Balance')
                    ->icon('heroicon-o-banknotes')
                    ->form([
                        Select::make('operation')
                            ->label('Operation')
                            ->options([
                                'add' => 'Add',
                                'subtract' => 'Subtract',
                            ])
                            ->required(),
                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->minValue(0.01)
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $amount = (float) $data['amount'];
                        $operation = $data['operation'];

                        if ($operation === 'add') {
                            $record->update([
                                'balance' => $record->balance + $amount,
                            ]);

                            if ($account = $record->user->account) {
                                $account->update([
                                    'balance' => $account->balance + $amount,
                                ]);
                            }
                        } elseif ($record->balance >= $amount) {
                            $record->update([
                                'balance' => $record->balance - $amount,
                            ]);

                            if ($account = $record->user->account) {
                                $account->update([
                                    'balance' => $account->balance - $amount,
                                ]);
                            }
                        } else {
                            Notification::make()
                                ->title('Insufficient balance')
                                ->warning()
                                ->send();

                            return;
                        }

                        Notification::make()
                            ->title('Balance updated successfully')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
