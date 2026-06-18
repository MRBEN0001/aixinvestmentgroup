<?php

namespace App\Filament\Resources\CoinResource\Pages;

use Filament\Actions;
use Illuminate\Http\RedirectResponse;
use App\Filament\Resources\CoinResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EditCoin extends EditRecord
{
    protected static string $resource = CoinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Top Up Wallet')
                ->form([
                    TextInput::make('amount')
                        ->label('Top Up Amount')
                        ->numeric()
                        ->required()
                ])->action(function (array $data) {
                    $this->record->update([
                        'balance' => $this->record->balance + $data['amount']
                    ]);
                    $investorAccount = $this->record->user->account;
                    $investorAccount->update([
                        'balance' => $investorAccount->balance + $data['amount'],
                    ]);


                    $this->notify('success', 'Balance Top Up Succesful');
                    return redirect('/admin/coins');
                })
        ];
    }
}
