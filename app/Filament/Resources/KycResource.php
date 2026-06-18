<?php

namespace App\Filament\Resources;

use App\Models\Kyc;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KycResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KycResource\RelationManagers;



class KycResource extends Resource
{
    protected static ?string $model = Kyc::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // KYC admin temporarily disabled — remove the block below to restore Filament navigation
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\TextInput::make('address'),
                Forms\Components\TextInput::make('city'),
                Forms\Components\TextInput::make('state'),
                Forms\Components\TextInput::make('zip'),
                Forms\Components\TextInput::make('id_type'),
                Forms\Components\FileUpload::make('id_front')->image(),
                Forms\Components\FileUpload::make('id_back')->image(),
                Forms\Components\FileUpload::make('passport_photo')->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('dob')->date(),
                TextColumn::make('city'),
                TextColumn::make('state'),
                TextColumn::make('zip'),
                TextColumn::make('id_type')->label('ID Type'),

            //     ImageColumn::make('id_front')
            //     ->label('ID Front')
            //     ->getStateUsing(fn ($record) => Storage::disk('public')->url($record->id_front)),
            
            // ImageColumn::make('id_back')
            //     ->label('ID Back')
            //     ->getStateUsing(fn ($record) => Storage::disk('public')->url($record->id_back)),
            
            // ImageColumn::make('passport_photo')
            //     ->label('Passport')
            //     ->getStateUsing(fn ($record) => Storage::disk('public')->url($record->passport_photo)),

                // ImageColumn::make('id_front')
                //     ->label('ID Front')
                //     ->disk('public') // This tells Filament to look inside storage/app/public
                //     ->visibility('visible'),

                // ImageColumn::make('id_back')
                //     ->label('ID Back')
                //     ->disk('public')
                //     ->visibility('visible'),

                // ImageColumn::make('passport_photo')
                //     ->label('Passport')
                //     ->disk('public')
                //     ->visibility('visible'),


                    
                    
                ImageColumn::make('id_front')
    ->label('ID Front')
    ->getStateUsing(fn ($record) => asset('storage/' . $record->id_front)),
                
    
            ImageColumn::make('id_back')
                ->label('ID Back')
                ->getStateUsing(fn ($record) => asset('storage/' . $record->id_back)),
            
            ImageColumn::make('passport_photo')
                ->label('Passport')
                ->getStateUsing(fn ($record) => asset('storage/' . $record->passport_photo)),


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
            'index' => Pages\ListKycs::route('/'),
            'create' => Pages\CreateKyc::route('/create'),
            'edit' => Pages\EditKyc::route('/{record}/edit'),
        ];
    }
}
