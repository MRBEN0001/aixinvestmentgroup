<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExchangeTransactionMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        $type = ucfirst($this->data['type'] ?? 'Transaction');

        return new Envelope(
            from: new Address(
                config('exchange.mail.from.address', 'noreply@aixexchange.top'),
                config('exchange.mail.from.name', 'AIX Exchange')
            ),
            subject: $this->data['subject'] ?? ("AIX Exchange {$type} Notification"),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.exchange-transaction',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
