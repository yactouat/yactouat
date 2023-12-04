<?php

namespace App\Mail;

use App\Services\SendGridMailerService;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

final class SendGridTransport extends AbstractTransport
{
    public function __construct(protected SendGridMailerService $client)
    {
        parent::__construct(); 
    }

    /**
     * {@inheritDoc}
     */
    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());
 
        $this->client->send(
            $email->getFrom()[0]->getAddress(),
            $email->getTo()[0]->getAddress(),
            $email->getSubject(),
            $email->getHtmlBody()
        );
    }
 
    /**
     * Get the string representation of the transport.
     */
    public function __toString(): string
    {
        return 'sendgrid';
    }
}