<?php
namespace App\Listeners;

use App\Notifications\SecurityAlertNotification;
use App\Services\IdentifierService;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\RateLimiter;
use Log;

class SendFailedLoginNotification
{
    public function __construct(
        protected IdentifierService $identifierService
    ) {
    }
    public function handle(Failed $event): void
    {
        $identifier = $event->credentials['identifier'] ?? null;
        if (!$identifier) {
            return;
        }
        $userKey = 'login_attempts_user:' . $identifier;
        $ipKey = 'login_attempts_ip:' . request()->ip();
        Log::info('key  '.$userKey . ' $ipKey ' . $ipKey);
        RateLimiter::hit($userKey, 600);
        if (RateLimiter::attempts($userKey) % 3 === 0 && $event->user) {
            $type = $this->identifierService->type($identifier);
            $event->user->notify(
                new SecurityAlertNotification($identifier, $type)
            );
        }
    }
}
