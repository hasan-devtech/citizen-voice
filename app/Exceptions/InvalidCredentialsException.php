<?php

namespace App\Exceptions;

class InvalidCredentialsException extends BaseApiException
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        parent::__construct('Invalid Credentials', 401);
    }
}
