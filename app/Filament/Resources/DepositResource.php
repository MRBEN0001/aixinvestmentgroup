<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Deposit;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserDepositApprovedMail;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DepositResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DepositResource\RelationManagers;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('reference')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Approve Deposit')
                    ->action(function ($record) {
                        if ($record->status === 'pending') {
                            DB::transaction(function () use ($record) {
                                // Update user's account balance
                                $account = $record->user->account;
                                $account->update([
                                    'balance' => $account->balance + $record->amount,
                                ]);

                                // Update related transaction status
                                $record->transaction->update([
                                    'status' => 'success',
                                ]);

                                // Update deposit status
                                $record->update([
                                    'status' => 'success',
                                ]);

                                try {

                                    $data = [
                                        'name' => $record->user->name,
                                        'amount' => $record->amount,
                                        'reference' => $record->reference,
                                        'approved_at' => now()->toDayDateTimeString(),
                                    ];
    
                                    Mail::to($record->user->email)->send(new UserDepositApprovedMail($data));
                                } catch (\Throwable $error) {
                                    Log::error('SMTP network error:' . $error->getMessage());
                                }
                            });

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
                    }),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeposits::route('/'),
            'create' => Pages\CreateDeposit::route('/create'),
            'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}
