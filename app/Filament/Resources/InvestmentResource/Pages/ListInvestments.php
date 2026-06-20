<?php

namespace App\Filament\Resources\InvestmentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\CreateAction;
use App\Filament\Resources\InvestmentResource;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ListInvestments extends ListRecords
{
    protected static string $resource = InvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableContentFooter(): ?View
    {
        return view ('filament/investment/footer');
    }

}
