<?php

namespace App\Services;

use App\DTOs\LoginResultDTO;
use App\Enums\OtpTypeEnum;
use App\Exceptions\IdentifierAlreadyExistsException;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\InvalidOtpException;
use App\Listeners\SendFailedLoginNotification;
use App\Models\Complainant;
use App\Repositories\ComplainantRepository;
use App\Repositories\OtpRepository;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ComplainantRepository $repository,
        protected OtpService $otpService,
        protected OtpRepository $otpRepo
    ) {
    }

    public function register(array $data)
    {
        $identifier = $data['identifier'];
        $existing = $this->repository->findByIdentifier($identifier);
        if ($existing) {
            throw new IdentifierAlreadyExistsException();
        }
        $this->repository->create($data);
        $this->otpService->sendOtp($identifier, OtpTypeEnum::REGISTER);
    }


    public function login(array $data)
    {
        $identifier = $data['identifier'];
        $user = $this->repository->findByIdentifier($identifier);
        if (!$user ||!$user->is_verified)
            throw new InvalidCredentialsException();
        if (!Hash::check($data['password'], $user->password)) {
            event(new Failed(
                'sanctum',
                $user,
                ['identifier' => $identifier]
            ));
            throw new InvalidCredentialsException();
        }
        $token = $user->createToken('citizen_token')->plainTextToken;
        return new LoginResultDTO($user, $token);
    }


    public function postOtpVerification(string $identifier, OtpTypeEnum $type)
    {
        switch ($type) {
            case OtpTypeEnum::REGISTER:
                $complainant = Complainant::where('identifier', $identifier)->first();
                if ($complainant && !$complainant->verified) {
                    $complainant->markAsVerified();
                }
                break;
            default:
                break;
        }
    }

    public function logout($user)
    {
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
    }

    public function forgetPassword(string $identifier)
    {
        $user = $this->repository->findByIdentifier($identifier);
        if (!$user) {
            throw new InvalidCredentialsException();
        }
        $this->otpService->sendOtp($identifier, OtpTypeEnum::RESET_PASSWORD);
    }

    public function resetPassword(string $identifier, string $code, string $newPassword, OtpTypeEnum $type)
    {
        $user = $this->repository->findByIdentifier($identifier);
        if (!$user) {
            throw new InvalidCredentialsException();
        }
        $this->otpService->verifyOtp($identifier, $code, $type);
        $user->update(['password' => $newPassword]);
        $user->tokens()->delete();
    }

    public function resendOtp(string $identifier, $type)
    {
        $type = OtpTypeEnum::from($type);
        $user = $this->repository->findByIdentifier($identifier);
        if (!$user) {
            throw new InvalidCredentialsException();
        }
        $this->otpService->sendOtp($identifier, $type);
    }

}
