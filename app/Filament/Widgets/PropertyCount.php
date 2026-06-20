<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PropertyCount extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Properties', Property::query()->count('id')),
        ];
    }
}
