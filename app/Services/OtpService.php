<?php

namespace App\Services;

use App\Enums\OtpTypeEnum;
use App\Exceptions\InvalidOtpException;
use App\Jobs\SendOtpEmailJob;
use App\Jobs\SendOtpSmsJob;
use App\Repositories\OtpRepository;
use App\Services\IdentifierService;
use Illuminate\Support\Facades\Hash;

class OtpService
{
    public function __construct(
        protected IdentifierService $identifierService,
        protected OtpRepository $otpRepo
    ) {
    }

    public function sendOtp(string $identifier, OtpTypeEnum $otpType)
    {
        $code = $this->generateOtp($identifier, $otpType);
        $type = $this->identifierService->type($identifier);
        if ($type === 'email') {
            SendOtpEmailJob::dispatch($identifier, $code);
        } else {
            SendOtpSmsJob::dispatch($identifier, $code);
        }
    }
    private function generateOtp(string $identifier, OtpTypeEnum $type)
    {
        $code = $this->generateCode();
        $this->otpRepo->create([
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
            'identifier' => $identifier,
            'type' => $type,
        ]);
        return $code;
    }

    public function verifyOtp(string $identifier, string $code, OtpTypeEnum $type)
    {
        $otp = $this->otpRepo->getOtp($identifier, $type);
        if (!$otp || !Hash::check($code, $otp->code)) {
            throw new InvalidOtpException();
        }
        $otp->update(['is_used' => true]);
    }
    private static function generateCode()
    {
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= random_int(0, 9);
        }
        return $code;
    }
}
