<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Plan;
use Filament\Tables;
use Faker\Core\Number;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PlanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PlanResource\RelationManagers;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    protected static ?string $navigationGroup = 'Company Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('title')->required(),
                Forms\Components\TextInput::make('duration')->label('Number of working days')->required()->placeholder('Enter number of working days')->numeric()->disabled(fn(Component $livewire): bool => $livewire instanceof EditRecord),
                Forms\Components\TextInput::make('max')->required()->placeholder('E.g Enter 5000 for $5000')->numeric(),
                Forms\Components\TextInput::make('min')->required()->placeholder('E.g Enter 5000 for $5000')->numeric(),
                Forms\Components\TextInput::make('percentage_return')->required()->placeholder('E.g Enter 5 for 5%')->numeric(),
                Forms\Components\TextInput::make('referral_bonus')->required()->placeholder('E.g Enter 5 for 5%')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('title')->searchable(),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('max'),
                Tables\Columns\TextColumn::make('min'),
                Tables\Columns\TextColumn::make('percentage_return'),
                Tables\Columns\TextColumn::make('referral_bonus'),
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
