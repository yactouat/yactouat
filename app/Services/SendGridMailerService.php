<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use SendGrid;
use SendGrid\Mail\Mail;

class SendGridMailerService
{
    private SendGrid $_sendgridClient;

    public function __construct()
    {
        $this->_sendgridClient = new SendGrid(config('services.sendgrid.key'));
    }

    public function send(string $from, string $to, string $subject, string $content): bool
    {
        $email = new Mail();
        $email->setFrom($from);
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent('text/html', $content);
        try {
            $this->_sendgridClient->send($email);
            return true;
        } catch (\Throwable $th) {
            Log::channel('stderr')->error(json_encode([
                "msg" => $th->getMessage(),
                "data" => [
                    "from" => $from,
                    "to" => $to,
                    "subject" => $subject,
                    "content" => $content,
                ]
            ]));
        }
        return false;
    }
}