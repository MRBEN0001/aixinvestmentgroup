<?php

namespace App\Filament\Resources\ExchangeWithdrawalResource\Pages;

use App\Filament\Resources\ExchangeWithdrawalResource;
use Filament\Resources\Pages\ListRecords;

class ListExchangeWithdrawals extends ListRecords
{
    protected static string $resource = ExchangeWithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
