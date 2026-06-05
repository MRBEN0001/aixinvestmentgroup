<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'account';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('account_number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('account_number')
            ->columns([
                Tables\Columns\TextColumn::make('account_number'),
                Tables\Columns\TextColumn::make('balance'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('Update Wallet Balance')->form([
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
                        ->required()
                ])->action(function ($record, array $data) {
                    $amount = $data['amount'];
                    $operation = $data['operation'];

                    if ($operation === 'add') {
                        $record->update([
                            'balance' => $record->balance + $amount
                        ]);
                    } elseif ($operation === 'subtract') {
                        if ($record->balance >= $amount) {
                            $record->update([
                                'balance' => $record->balance - $amount
                            ]);
                        } else {
                            Notification::make()
                                ->title('Insufficient Balance')
                                ->warning()
                                ->send();
                            return;
                        }
                    }

                    Notification::make()
                        ->title('Balance Update Successful')
                        ->success()
                        ->send();
                })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
