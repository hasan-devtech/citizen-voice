<?php

namespace App\Exceptions;

class InvalidOtpException extends BaseApiException
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        parent::__construct("Invalid Code");
    }
}
