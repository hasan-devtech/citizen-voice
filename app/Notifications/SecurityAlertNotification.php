<?php
namespace App\Notifications;

use App\Services\SmsOtpService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SecurityAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $identifier,
        protected string $type
    ) {
    }

    public function via(object $notifiable): array
    {
        return $this->type === 'email' ? ['mail'] : ['custom_sms'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Security Alert: Failed Login Attempts')
            ->line('Multiple failed login attempts were detected')
            ->line('Your account may be temporarily blocked')
            ->line('If this was not you, secure your account immediately');
    }

    public function toCustomSms(object $notifiable)
    {
        return app(SmsOtpService::class)->send(
            $this->identifier,
            'Security alert: multiple failed login attempts detected'
        );
    }
}

