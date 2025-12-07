<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Illuminate\Support\Facades\Log;

class FcmChannel
{
    protected Messaging $messaging;

    public function __construct()
    {
        $this->messaging = (new Factory)
            ->withServiceAccount(config('firebase.projects.app.credentials'))
            ->createMessaging();
    }

    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toFcm')) {
            return;
        }
        $fcmMessage = $notification->toFcm($notifiable);
        $tokens = $notifiable->fcmTokens()->pluck('token')->toArray();
        if (empty($tokens)) {
            return;
        }
        try {
            $this->messaging->sendMulticast($fcmMessage, $tokens);
        } catch (\Throwable $e) {
            Log::error('FCM send failed', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
