<?php

namespace App\Jobs;

use App\Notifications\OtpNotification;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SendOtpEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $identifier;
    public string $code;
    public $tries = 3;

    public function __construct(string $identifier, string $code)
    {
        $this->identifier = $identifier;
        $this->code = $code;
        $this->onQueue('otp-mail');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Notification::route('mail', $this->identifier)
                ->notify(new OtpNotification($this->code));
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP email', [
                'identifier' => $this->identifier,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
