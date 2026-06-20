<?php

namespace App\Filament\Resources\WalletKycResource\Pages;

use App\Filament\Resources\WalletKycResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWalletKyc extends EditRecord
{
    protected static string $resource = WalletKycResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
