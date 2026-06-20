<?php

namespace App\Filament\Resources\WithdrawalResource\Pages;

use Filament\Actions;
use App\Models\CompanyWallet;
use Illuminate\Support\Facades\Log;
use App\Mail\WithdrawalApproaveMail;
use Illuminate\Support\Facades\Mail;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WithdrawalResource;

class EditWithdrawal extends EditRecord
{
    protected static string $resource = WithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('approve')
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => withdrawalStatuses()['approaved'],
                    ]);

                    $selectedCoin = getSelectedCoin($this->record->user->id, $this->record->company_wallet_id);
                    $coinName = CompanyWallet::find($this->record->company_wallet_id);

                    try {
                        Mail::to($this->record->user->email)->send(new WithdrawalApproaveMail([
                            'name' => $this->record->user->name,
                            'amount' => $this->record->amount,
                            'wallet_address' => $selectedCoin->wallet_address,
                            'coin' => $coinName->coin
                        ]));
                        $this->notify('success', 'Withdrawal Approved');
                    } catch (\Throwable $error) {
                        Log::error('SMTP network error:' . $error->getMessage());
                        $this->notify('success', 'Withdrawal Approved!');
                        return back();
                    }
                })
        ];
    }
}
