<?php

namespace App\Filament\Resources\CompanyWalletResource\Pages;

use App\Filament\Resources\CompanyWalletResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyWallet extends EditRecord
{
    protected static string $resource = CompanyWalletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
