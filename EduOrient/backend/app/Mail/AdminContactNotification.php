<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contact $contact
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau message de contact — ProLink',
            replyTo: [
                new Address($this->contact->email),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.admin-contact-notification',
        );
    }
}
