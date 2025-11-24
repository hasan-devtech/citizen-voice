<?php
namespace App\DTOs;

class LoginResultDTO
{
    public function __construct(
        public $user,
        public string $token
    ) {
    }
    public function toArray(): array
    {
        return [
            'user' => $this->user->asResource(),
            'token' => $this->token,
        ];
    }
}