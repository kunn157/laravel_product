<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The mails instance.
     *
     * @var array $mails
     */
    protected $mails;
    /**
     * Create a new message instance.
     *
     * @param array $mails
     * @return void
     */
    public function __construct(array $mails)
    {
        $this->mails = $mails;
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: $this->mails['subject'],
    //     );
    // }
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: $this->mails['view'],
            with: [
                'user' => $this->mails['user']
            ]
        );
    }
}
