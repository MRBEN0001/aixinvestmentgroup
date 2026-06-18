<?php

namespace App\Filament\Resources;


use Filament\Forms;
use Filament\Tables;
use App\Models\Withdrawal;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use App\Mail\WithdrawalApproaveMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WithdrawalResource\Pages;
use App\Filament\Resources\WithdrawalResource\RelationManagers;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Manage User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('user.name')->disabled(),
                Forms\Components\TextInput::make('amount')->disabled(),
                // Forms\Components\TextInput::make('companyWallet.coin')->disabled(),
                Forms\Components\TextInput::make('status')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('companyWallet.coin')->searchable(),
                Tables\Columns\TextColumn::make('status')->searchable(),

            ])
            ->filters([
                Filter::make('pending')
                    ->query(fn (Builder $query): Builder => $query->where('status', withdrawalStatuses()['pending']))
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('View'),
                // Action::make('approve')
                //     ->action(function (Withdrawal $withdrawal) {
                //         $withdrawal->update([
                //             'status' => 'approaved',
                //             'has_withdrawn' => 'true'
                //         ]);
                //         Mail::to($withdrawal->user->email)->send(new WithdrawalApproaveMail([
                //             'name' => $withdrawal->user->name,
                //             'amount' => $withdrawal->amount,
                //         ]));
                //         Filament::notify('success', 'Withdrawal Approaved');
                //     })
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListWithdrawals::route('/'),
            'create' => Pages\CreateWithdrawal::route('/create'),
            'edit' => Pages\EditWithdrawal::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    // public static function canEdit(Model $record): bool
    // {
    //     return false;
    // }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::where('status', withdrawalStatuses()['pending'])->count();
    }
}
