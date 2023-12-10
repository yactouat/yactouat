<?php

namespace App\Mail;

use App\Models\PersistedSignedRoute;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

abstract class AppMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $unsubscribeUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user, private PersistedSignedRoute $persistedSignedRoute)
    {
        $this->unsubscribeUrl = resolve('SignedRouteService')->makeUrl($persistedSignedRoute);
    }

    /**
     * Get the message envelope.
     */
    public abstract function envelope(): Envelope;

    /**
     * Get the message content definition.
     */
    public abstract function content(): Content;

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public abstract function attachments(): array;

}
