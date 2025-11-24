<?php

namespace App\Http\Controllers\Api;

use App\Enums\OtpTypeEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOtpRequest;
use App\Services\AuthService;
use App\Services\OtpService;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function __construct(
        protected OtpService $otpService,
        protected AuthService $authService,
    ) {
    }
    public function verifyOtp(VerifyOtpRequest $request)
    {
        $data = $request->validated();
        $otpType = OtpTypeEnum::from($data['type']);
        $this->otpService->verifyOtp($data['identifier'], $data['otp'], $otpType);
        $this->authService->postOtpVerification($data['identifier'], $otpType);
        return ResponseHelper::success('Verified successfully');
    }

}
