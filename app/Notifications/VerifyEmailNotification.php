<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmailBase
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email Akun Smart Library')
            ->markdown('emails.auth.verify-email', [
                'url' => $verificationUrl,
                'count' => config('auth.verification.expire', 60),
                'name' => $notifiable->name,
            ]);
    }
}
