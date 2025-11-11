<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayoutSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
   public function __construct($plan, $amount)
{
    $this->plan = $plan;
    $this->amount = $amount;
}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payout Success Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
    
    public $plan, $amount;



public function build()
{
    return $this->subject('Your Mining Plan Has Matured')
                ->view('emails.payout_success');
}

}
