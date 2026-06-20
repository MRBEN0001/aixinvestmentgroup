<?php

namespace App\Filament\Resources\WalletKycResource\Pages;

use App\Filament\Resources\WalletKycResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWalletKycs extends ListRecords
{
    protected static string $resource = WalletKycResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
