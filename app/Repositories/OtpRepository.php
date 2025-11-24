<?php

namespace App\Repositories;

use App\Enums\OtpTypeEnum;
use App\Models\OTP;

class OtpRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function create(array $data)
    {
        return OTP::create($data);
    }
    public function getOtp(string $identifier, OtpTypeEnum $type): ?Otp
    {
        return Otp::where('identifier', $identifier)
            ->where('type', $type->value)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();
    }
}
