<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use RuntimeException;

class MailerService
{
    /**
     * Send a branded HTML investor email through the application's SMTP mailer.
     */
    public function send(
        string $recipient,
        string $subject,
        string $body,
        array $data = []
    ): void {
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

        Mail::mailer('smtp')->send('emails.admin-message', array_merge([
            'subject' => $subject,
            'body' => $body,
            'recipientName' => 'Investor',
            'reference' => '3IQ-' . strtoupper(substr(sha1($recipient . microtime(true)), 0, 10)),
            'dashboardUrl' => rtrim(config('app.url'), '/') . '/dashboard',
            'accountLevel' => null,
        ], $data), function ($message) use ($recipient, $subject): void {
            $message->to($recipient)->subject($subject);
        });
    }

    /**
     * Send the dedicated account verification email.
     */
    public function sendVerificationEmail(
        string $recipient,
        string $recipientName,
        string $verificationUrl,
        string $reference
    ): void {
        $recipient = trim($recipient);
        $recipientName = trim($recipientName) ?: 'Investor';
        $verificationUrl = trim($verificationUrl);
        $reference = trim($reference);

        if ($recipient === '' || !filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('A valid recipient email address is required.');
        }

        if ($verificationUrl === '') {
            throw new RuntimeException('A verification URL is required.');
        }

        Mail::mailer('smtp')->send('emails.verify-account', [
            'recipientName' => $recipientName,
            'verificationUrl' => $verificationUrl,
            'reference' => $reference,
        ], function ($message) use ($recipient): void {
            $message->to($recipient)->subject('Verify your 3IQTrading account');
        });
    }
}
