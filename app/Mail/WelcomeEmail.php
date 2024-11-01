<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailMessage;
    public $subject;
    public $details;
    public $picture;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $subject, $details, $picture)
    {
        $this->mailMessage = $message;
        $this->subject = $subject;
        $this->details = $details;
        $this->picture = $picture;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.welcome_mail',
            // with: [
            //     'product' => $this->details['product'],
            //     'price' => $this->details['price'],
            //     'mailMessage' => $this->mailMessage,
            //     'subject' => $this->subject,
            // ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        if($this->picture){
            $attachments[] = Attachment::fromPath(storage_path('app/public/' . $this->picture));
        }
        return $attachments;
    }
}
