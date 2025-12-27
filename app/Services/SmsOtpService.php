<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsOtpService
{
    public function send(string $phone, string $message): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => config('services.sms.token'),
                'Accept' => 'application/json',
            ])->post(config('services.sms.gateway_url'), [
                        'to' => $phone,
                        'message' => $message,
                    ]);
            if (!$response->successful()) {
                Log::error('SMS sending failed', [
                    'phone' => "+963" . $phone,
                    'response' => $response->body(),
                ]);
                return false;
            }
            return true;
        } catch (\Throwable $e) {
            Log::error('SMS Exception', [
                'phone' => $phone,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
