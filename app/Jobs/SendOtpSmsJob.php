<?php

namespace App\Jobs;

use App\Services\SmsOtpService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendOtpSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $phone;
    public string $code;
    public $tries = 3;

    public function __construct(string $phone, string $code)
    {
        $this->phone = $phone;
        $this->code = $code;
        $this->onQueue('otp-sms');
    }

    public function handle(SmsOtpService $smsService): void
    {
        // Log::info($this->phone . "heeeeeey");
        $sent = $smsService->send($this->phone, "Your OTP code: {$this->code}");
        if (!$sent) {
            Log::warning('OTP SMS failed, will retry', ['phone' => $this->phone]);
            throw new \Exception('SMS sending failed');
        }
    }
}
