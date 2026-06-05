<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use DateTime;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('amount')
            ->columns([
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('transaction_type'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Action::make('Create Transaction')
                    ->form([
                        Select::make('transaction_type')
                            ->label('Transaction Type')
                            ->options([
                                'deposit' => 'Deposit',
                                'withdrawal' => 'Withdrawal',
                                'purchase' => 'Purchase',
                            ])
                            ->required(),

                        Select::make('status')
                            ->label('Transaction Status')
                            ->options([
                                // 'approved' => 'Approved',
                                // 'pending' => 'Pending',
                                // 'declined' => 'Declined',
                                'success' => 'Success',
                                'pending' => 'Pending',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),

                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->required(),
                        TextInput::make('description')
                            ->label('Description')
                            ->required(),
                            DateTimePicker::make('created_at')
                            ])
                    ->action(function (array $data, $livewire) {
                        $parent = $livewire->getOwnerRecord(); // Gets the parent model of the relation

                        $parent->transactions()->create([
                            'user_id' => $parent->id,
                            'account_id' => $parent->account->id ?? null,
                            'transaction_type' => $data['transaction_type'],
                            'description' => $data['description'],
                            'status' => $data['status'],
                            'amount' => $data['amount'],
                            'created_at' => $data['created_at']
                        ]);

                        Notification::make()
                            ->title('Transaction Created Successfully')
                            ->success()
                            ->send();
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
