<?php

namespace App\Notifications;

use App\Enums\OtpTypeEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpNotification extends Notification 
{

    public string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }


    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your OTP Code') 
            ->line("Your OTP code is: {$this->code}") 
            ->line('This code expires in 10 minutes.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

}
