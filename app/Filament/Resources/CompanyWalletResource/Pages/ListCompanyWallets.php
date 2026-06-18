<?php

namespace App\Filament\Resources\CompanyWalletResource\Pages;

use App\Filament\Resources\CompanyWalletResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyWallets extends ListRecords
{
    protected static string $resource = CompanyWalletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
