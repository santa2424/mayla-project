<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;

    public function __construct($order, $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mayla Cosmetics'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.order-mail'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
