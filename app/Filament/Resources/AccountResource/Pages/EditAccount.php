<?php

namespace App\Filament\Resources\AccountResource\Pages;

use App\Filament\Resources\AccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccount extends EditRecord
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['balance'] = $data['balance'] * 100;
        return $data;
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['balance'] = $data['balance'] / 100;
        return $data;
    }
}
