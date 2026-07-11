<?php

namespace App\Filament\Resources\ExchangeDepositResource\Pages;

use App\Filament\Resources\ExchangeDepositResource;
use Filament\Resources\Pages\ListRecords;

class ListExchangeDeposits extends ListRecords
{
    protected static string $resource = ExchangeDepositResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
