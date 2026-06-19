<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Coin;
use App\Models\User;
use App\Mail\AdminMail;
use App\Models\Investment;
use Illuminate\Console\Command;
use App\Models\ReferralCommission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvestorWasPaidTodayMail;
use App\Mail\InvestorPaymentCompletedMail;
use App\Mail\PartnersPaymentCompletedMail;

class PayInvestor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:investor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commands automatically pays investor roi once payement due date is reached';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::transaction(function () {
            $activeInvestments = Investment::where('status', investmentStatuses()['active'])->get();

            foreach ($activeInvestments as $investment) {
                // Parse the start date and the next payment date using Carbon
                $startDate = Carbon::parse($investment->start_date);
                $nextPaymentDate = $investment->next_payment_date ? Carbon::parse($investment->next_payment_date) : $startDate;
                $lastPaymentDate = $investment->last_payment_date ? Carbon::parse($investment->last_payment_date) : null;

                // Check if today is a weekday and the next payment date is today or has passed
                if ($nextPaymentDate->isWeekday() && $nextPaymentDate->lte(Carbon::now())) {
                    // Ensure the payment is only made once per day
                    if ($lastPaymentDate === null || $lastPaymentDate->lt(Carbon::today())) {
                        // Fetch the coin invested by the user for this investment
                        $coinInvested = Coin::where('user_id', $investment->user_id)
                            ->where('company_wallet_id', $investment->company_wallet_id)
                            ->first();

                        // Update the coin balance by adding the ROI for this payment
                        $updateCoinBalance = $coinInvested->update([
                            'balance' => $coinInvested->balance + $investment->roi
                        ]);

                        if ($updateCoinBalance) {
                            // Update the user account balance and earned total
                            $investment->user->account->update([
                                'balance' => $investment->user->account->balance + $investment->roi,
                                'earned_total' => $investment->user->account->earned_total + $investment->roi
                            ]);



                            // Handle referral payment if applicable
                            if ($investment->user->referral) {
                                $this->payInvestorReferral($investment);
                            }

                            // Update the last payment date to today
                            $investment->update([
                                'last_payment_date' => Carbon::today()
                            ]);

                


                            $this->sendPaymentEmail(
                                $investment->user->email,
                                new InvestorPaymentCompletedMail([
                                    'name' => $investment->user->name,
                                    'roi' => $investment->roi,
                                    'coin' => $investment->companyWallet->coin,
                                ])
                            );

                            $this->sendPaymentEmail(
                                adminMailTo(),
                                new InvestorWasPaidTodayMail([])
                            );
                        }

                        // Calculate the next payment date by adding 1 weekday
                        $workingDaysPaid = $investment->working_days_paid + 1;
                        $investment->update([
                            'next_payment_date' => $nextPaymentDate->copy()->addWeekday(),
                            'working_days_paid' => $workingDaysPaid
                        ]);

                        // Close the investment after 6 working days of payments
                        if ($workingDaysPaid >= 6) {
                            $coinInvested->update([
                                'balance' => $coinInvested->balance + $investment->amount
                            ]);
                            $investment->user->account->update([
                                'balance' => $investment->user->account->balance + $investment->amount,
                            ]);
                            $investment->update([
                                'status' => investmentStatuses()['closed']
                            ]);
                        }
                        $this->sendPaymentEmail(
                            adminMailTo(),
                            new AdminMail([
                                'subject' => 'New Payment Notification',
                                'name' => $investment->user->name,
                                'roi' => $investment->roi,
                                'coin' => $investment->companyWallet->coin,
                            ])
                        );

                        $this->info("Payment processed for {$investment->user->name}");
                    }
                }
            }
        });
    }



    private function getInvestorReferral($investor)
    {
        $user = User::find($investor);
        $userReferralId = $user->referral;
        $referral = User::where('referral_link', $userReferralId)->first();
        return $referral;
    }

    private function payInvestorReferral($investment)
    {
        $investorReferral = $this->getInvestorReferral($investment->user_id);

        $referralCommission = ReferralCommission::where('user_id', $investorReferral->id)->where('investment_id', $investment->id)->where('is_paid', false)->first();

        if ($referralCommission) {
            $bonus = $investment->amount * ($investment->plan->referral_bonus / 100);
            $investorReferral->account->update([
                // 'balance' => $investorReferral->account->balance + $referralCommission->commission,
                'total_referral_commission' => $investorReferral->account->total_referral_commission + $bonus
            ]);

            $referralCommission->update([
                'is_paid' => true,
            ]);

            $this->sendPaymentEmail(
                $investorReferral->email,
                new PartnersPaymentCompletedMail([
                    'name' => $investorReferral->name,
                    'commission' => $bonus,
                    'investorName' => $investment->user->name,
                ])
            );
        }
    }

    private function sendPaymentEmail(string $to, $mailable): void
    {
        try {
            Mail::to($to)->send($mailable);
        } catch (\Throwable $error) {
            Log::error('Payment notification email failed', [
                'to' => $to,
                'mailable' => get_class($mailable),
                'error' => $error->getMessage(),
            ]);
            $this->warn("Email to {$to} failed: {$error->getMessage()}");
        }
    }
}
