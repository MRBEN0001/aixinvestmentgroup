<?php

namespace App\Filament\Resources\InvestmentResource\Pages;

use Carbon\Carbon;
use App\Models\Plan;
use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvestmentActivatedMail;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\InvestmentResource;

class EditInvestment extends EditRecord
{
    protected static string $resource = InvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('approve')
                ->action(function (array $data) {
                    $this->record->update([
                        'due_date' => $this->getInvestmentDueDate($this->record->plan->id),
                        'status' => investmentStatuses()['active']
                    ]);

                    try {
                        Mail::to($this->record->user->email)->send(new InvestmentActivatedMail([
                            'name' => $this->record->user->name,
                            'amount' => $this->record->amount,
                            'coin' => $this->record->companyWallet->coin,
                            'due_date' => $this->record->start_date
                        ]));
                        $this->notify('success', 'Investment Activated');
                    } catch (\Throwable $error) {
                        Log::error('SMTP network error:' . $error->getMessage());
                        $this->notify('success', 'Investment Activated');
                        return back();
                    }
                })
        ];
    }

    private function getInvestmentDueDate($id)
    {
        $selectedPlan = Plan::find($id);

        $investmentDueTime = Carbon::now()->addDays($selectedPlan->plan)->toDateString();
        return $investmentDueTime;
    }
}
