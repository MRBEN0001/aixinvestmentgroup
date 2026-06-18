<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class InvestorWithdrawalMail extends Mailable
{
    public $data;

    use Queueable, SerializesModels;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Your Withdrawal Request Has Been Received',
        );
    }

    public function content()
    {
        return new Content(
            markdown: 'emails.investorWithdrawal',
        );
    }

    public function attachments()
    {
        return [];
    }
}
