<?php

namespace App\Filament\Resources\CompanyWalletResource\Pages;

use App\Filament\Resources\CompanyWalletResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyWallet extends CreateRecord
{
    protected static string $resource = CompanyWalletResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
