<?php

namespace App\Exceptions;

use Exception;

abstract class BaseApiException extends Exception
{
    protected int $statusCode;
    protected array $errors;

    public function __construct(string $message = 'Something went wrong', int $statusCode = 400, array $errors = [])
    {
        parent::__construct(message: $message);
        $this->statusCode = $statusCode;
        $this->errors = $errors;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
