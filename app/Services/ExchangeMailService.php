<?php

namespace App\Services;

use App\Mail\ExchangeTransactionMail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExchangeMailService
{
    public function notifyTransaction(User $user, array $payload): void
    {
        if (! $user->email) {
            return;
        }

        $type = strtolower($payload['type'] ?? 'transaction');

        $data = array_merge([
            'name' => $user->name,
            'type' => $type,
            'title' => $payload['title'] ?? $this->defaultTitle($type),
            'subject' => $payload['subject'] ?? $this->defaultSubject($type),
            'message' => $payload['message'] ?? $this->defaultMessage($type),
            'amount_label' => $payload['amount_label'] ?? null,
            'status' => $payload['status'] ?? null,
            'reference' => $payload['reference'] ?? null,
            'reference_label' => $payload['reference_label'] ?? 'Reference',
            'details' => $payload['details'] ?? null,
        ], $payload);

        try {
            Mail::to($user->email)->send(new ExchangeTransactionMail($data));
        } catch (\Throwable $error) {
            Log::error('Exchange transaction email failed: ' . $error->getMessage(), [
                'user_id' => $user->id,
                'type' => $type,
            ]);
        }
    }

    public function notifyAdmin(array $payload): void
    {
        $adminEmail = function_exists('adminMailTo') ? adminMailTo() : config('app.mail_to');

        if (! $adminEmail) {
            return;
        }

        $type = strtolower($payload['type'] ?? 'transaction');

        $data = array_merge([
            'name' => 'Admin',
            'type' => $type,
            'title' => $payload['title'] ?? 'Exchange Notification',
            'subject' => $payload['subject'] ?? 'AIX Exchange Admin Notification',
            'message' => $payload['message'] ?? 'There is a new exchange activity requiring attention.',
            'amount_label' => $payload['amount_label'] ?? null,
            'status' => $payload['status'] ?? null,
            'reference' => $payload['reference'] ?? null,
            'reference_label' => $payload['reference_label'] ?? 'Reference',
            'details' => $payload['details'] ?? null,
        ], $payload);

        try {
            Mail::to($adminEmail)->send(new ExchangeTransactionMail($data));
        } catch (\Throwable $error) {
            Log::error('Exchange admin email failed: ' . $error->getMessage(), [
                'type' => $type,
            ]);
        }
    }

    public function notifyFromTransaction(User $user, Transaction $transaction, ?string $message = null): void
    {
        $this->notifyTransaction($user, [
            'type' => $transaction->transaction_type,
            'title' => $this->defaultTitle($transaction->transaction_type),
            'subject' => $this->defaultSubject($transaction->transaction_type),
            'message' => $message ?? $this->defaultMessage($transaction->transaction_type),
            'amount_label' => '$' . number_format((float) $transaction->amount, 2),
            'status' => $transaction->status,
            'details' => $transaction->description,
        ]);
    }

    private function defaultTitle(string $type): string
    {
        return match ($type) {
            'deposit' => 'Deposit Update',
            'trade' => 'Trade Completed',
            'withdrawal' => 'Withdrawal Update',
            'transfer' => 'Transfer Update',
            'purchase' => 'Purchase Update',
            default => 'Transaction Update',
        };
    }

    private function defaultSubject(string $type): string
    {
        return match ($type) {
            'deposit' => 'AIX Exchange Deposit Notification',
            'trade' => 'AIX Exchange Trade Confirmation',
            'withdrawal' => 'AIX Exchange Withdrawal Notification',
            'transfer' => 'AIX Exchange Transfer Notification',
            'purchase' => 'AIX Exchange Purchase Notification',
            default => 'AIX Exchange Transaction Notification',
        };
    }

    private function defaultMessage(string $type): string
    {
        return match ($type) {
            'deposit' => 'Your exchange deposit activity has been recorded.',
            'trade' => 'Your trade on AIX Exchange was completed successfully.',
            'withdrawal' => 'Your exchange withdrawal activity has been recorded.',
            'transfer' => 'Your exchange transfer activity has been recorded.',
            'purchase' => 'Your exchange purchase activity has been recorded.',
            default => 'You have a new transaction on AIX Exchange.',
        };
    }
}
