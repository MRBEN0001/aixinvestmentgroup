<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\CompanyWallet;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CompanyWalletResource\Pages;
use Illuminate\Database\Eloquent\Model;

class CompanyWalletResource extends Resource
{
    protected static ?string $model = CompanyWallet::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-minus';

    protected static ?string $navigationGroup = 'Company Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\TextInput::make('coin')->required(),
                    Forms\Components\TextInput::make('abbr')->required(),
                    Forms\Components\TextInput::make('wallet_address')->required(),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('coin')->searchable(),
                Tables\Columns\TextColumn::make('abbr'),
                Tables\Columns\TextColumn::make('wallet_address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCompanyWallets::route('/'),
            'create' => Pages\CreateCompanyWallet::route('/create'),
            'edit' => Pages\EditCompanyWallet::route('/{record}/edit'),
        ];
    }
    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
