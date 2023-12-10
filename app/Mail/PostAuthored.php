<?php

namespace App\Mail;

use App\Models\PersistedSignedRoute;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostAuthored extends AppMail
{
    use Queueable, SerializesModels;

    public string $authedUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public User $user, 
        public Post $post,
        private PersistedSignedRoute $unsubscribeRoute,
        private PersistedSignedRoute $authedPostRoute
    )
    {
        parent::__construct($user, $unsubscribeRoute);
        $this->authedUrl = resolve('SignedRouteService')->makeUrl($authedPostRoute);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'post Authored',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.post.authored',
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
