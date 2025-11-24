<?php

namespace App\Http\Controllers\Api;

use App\Enums\OtpTypeEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Complainant\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendOtpRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {
    }
    public function register(RegisterRequest $request)
    {
        $this->authService->register($request->validated());
        return ResponseHelper::success(message: 'registered successfully', status: 201);
    }

    public function login(LoginRequest $request)
    {
        $response = $this->authService->login(
            $request->validated()
        );
        return ResponseHelper::success(
            $response->toArray(),
            "Login Successfully"
        );
    }
    public function logout(Request $request)
    {
        $this->authService->logout($request->user());
        return ResponseHelper::success("logged out successfully.");
    }

    public function forgetPassword(Request $request)
    {
        $request->validate(['identifier' => 'required', 'string', 'max:127']);
        $this->authService->forgetPassword($request->identifier);
        return ResponseHelper::success(message: 'The otp for reset your password sent succefully');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        $this->authService->resetPassword($data['identifier'], $data['otp'], $data['password'], OtpTypeEnum::RESET_PASSWORD);
        return ResponseHelper::success(message: "Password Reset Successfully");
    }

    public function resendOtp(SendOtpRequest $request)
    {
        $data = $request->validated();
        $this->authService->resendOtp($data['identifier'],$data['type']);
        return ResponseHelper::success();
    }

}
