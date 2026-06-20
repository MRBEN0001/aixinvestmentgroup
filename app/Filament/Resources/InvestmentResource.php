<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Plan;
use Filament\Tables;
use App\Models\Investment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\NewInvestmentNotificationMail;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InvestmentResource\Pages;
use App\Filament\Resources\InvestmentResource\RelationManagers;

class InvestmentResource extends Resource
{
    protected static ?string $model = Investment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Manage User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user.name')->disabled(),
                Forms\Components\TextInput::make('companyWallet.coin')->disabled(),
                Forms\Components\TextInput::make('amount'),
                Forms\Components\TextInput::make('roi')->disabled(),
                Forms\Components\TextInput::make('next_payment_date')->disabled(),
                Forms\Components\TextInput::make('last_payment_date')->disabled(),
                Forms\Components\TextInput::make('working_days_paid')->disabled(),
                Forms\Components\TextInput::make('start_date')->disabled(),
                Forms\Components\TextInput::make('transaction_reference')->disabled(),
                Forms\Components\TextInput::make('status')->disabled(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\TextColumn::make('companyWallet.coin')->searchable(),
                // Tables\Columns\TextColumn::make('plan.plan')->searchable(),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('roi'),
                Tables\Columns\TextColumn::make('transaction_reference'),
                Tables\Columns\TextColumn::make('start_date'),
                // Tables\Columns\TextColumn::make('next_payment_date'),
                Tables\Columns\TextColumn::make('working_days_paid')->label('Number of payment made'),
                Tables\Columns\TextColumn::make('last_payment_date'),
                // Tables\Columns\TextColumn::make('due_date')->searchable(),
                Tables\Columns\TextColumn::make('status')->searchable(),
                // Tables\Columns\TextColumn::make('has_withdrawn'),
            ])
            ->filters([
                Filter::make('pending')
                    ->query(fn(Builder $query): Builder => $query->where('status', investmentStatuses()['pending']))

            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('View')
                    ->url(fn($record) => url("/admin/users/{$record->user_id}/edit?activeRelationManager=0"))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
        // Filter::make('status')->label('pending');

    }


    public static function getInvestmentDueDate($id)
    {
        $selectedPlan = Plan::find($id);
        $investmentDueTime = Carbon::now()->addDays($selectedPlan->plan)->toDateString();
        return $investmentDueTime;
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
            'index' => Pages\ListInvestments::route('/'),
            // 'create' => Pages\CreateInvestment::route('/create'),
            'edit' => Pages\EditInvestment::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::where('status', investmentStatuses()['pending'])->count();
    }
    // public static function canEdit(Model $record): bool
    // {
    //     return false;
    // }
}
