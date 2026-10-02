<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use RuntimeException;

class MailerService
{
    /**
     * Send a plain-text email through the application's configured SMTP mailer.
     */
    public function send(string $recipient, string $subject, string $body): void
    {
        $recipient = trim($recipient);
        $subject = trim($subject);
        $body = trim($body);

        if ($recipient === '' || !filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('A valid recipient email address is required.');
        }

        if ($subject === '') {
            throw new RuntimeException('Email subject is required.');
        }

        if ($body === '') {
            throw new RuntimeException('Email message is required.');
        }

        Mail::mailer('smtp')->raw($body, function ($message) use ($recipient, $subject): void {
            $message->to($recipient)->subject($subject);
        });
    }
}
