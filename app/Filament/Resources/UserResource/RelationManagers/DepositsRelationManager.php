<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class DepositsRelationManager extends RelationManager
{
    protected static string $relationship = 'deposits';

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
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')->label('Date'),
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
                Action::make('Approve Deposit')
                ->form([]) // Can be removed if no input is required
                ->action(function ($record, array $data) {
            
                    if ($record->status === 'pending') {
                        $record->user->account->update([
                            'balance' => $record->user->account->balance + $record->amount,
                        ]);
                        $record->transaction->update([
                            'status' => 'success'
                        ]);
                        $record->update([
                            'status' => 'success',
                        ]);
            
                        Notification::make()
                            ->title('User balance updated successfully')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Deposit already approved')
                            ->warning()
                            ->send();
                    }
                })
            
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
