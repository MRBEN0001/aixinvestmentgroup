<?php

namespace App\Filament\Resources\TeslaProductResource\Pages;

use App\Filament\Resources\TeslaProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeslaProducts extends ListRecords
{
    protected static string $resource = TeslaProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
