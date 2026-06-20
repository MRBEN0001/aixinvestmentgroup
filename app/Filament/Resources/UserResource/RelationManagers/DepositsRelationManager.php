<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Mail\DepositMail;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Mail\DepositDeclineMail;
use App\Mail\DepositApprovalMail;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class DepositsRelationManager extends RelationManager
{
    protected static string $relationship = 'deposits';

    protected static ?string $recordTitleAttribute = 'reference';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->label('Transaction Hash'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('companyWallet.coin'),
                Tables\Columns\TextColumn::make('amount'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Action::make('changeStatus')
                    ->label(fn ($record) => $record->status == 'approved' ? 'Confirmed' : ($record->status == 'declined' ? 'Declined' : 'Update Deposit Status'))
                    ->color(fn ($record) => $record->status == 'approved' ? 'success' : ($record->status == 'declined' ? 'danger' : 'primary'))
                    ->form([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'approved' => 'Approve',
                                'declined' => 'Decline',
                            ])
                            ->required()
                    ])
                    ->action(function ($record, array $data) {
                        $newStatus = $data['status'];

                        $record->update([
                            'status' => $newStatus
                        ]);

                        try {
                            if ($newStatus == 'approved') {
                                Mail::to($record->user->email)->send(new DepositApprovalMail([
                                    'name' => $record->user->name,
                                    'amount' => $record->amount,
                                    'coin' => $record->companyWallet->coin,
                                ]));
                            } elseif ($newStatus == 'declined') {
                                Mail::to($record->user->email)->send(new DepositDeclineMail([
                                    'name' => $record->user->name,
                                    'amount' => $record->amount,
                                    'coin' => $record->companyWallet->coin,
                                ]));
                            }

                            Notification::make()
                                ->title('Deposit Status Changed')
                                ->success()
                                ->send();
                        } catch (\Throwable $error) {
                            Log::error('SMTP network error:' . $error->getMessage());
                            Notification::make()
                                ->title('Deposit Status Changed with Notification Error')
                                ->warning()
                                ->send();
                            return back();
                        }
                    })
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
