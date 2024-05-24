<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EjemploMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject="Curso Laravel";
    public $texto="";
    /**
     * Create a new message instance.
     */
    public function __construct($texto)
    {
        $this->texto=$texto;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ejemplo Mailable',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return $this->view('email.ejemplo');
        return new Content(
            view: 'email.ejemplo',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
