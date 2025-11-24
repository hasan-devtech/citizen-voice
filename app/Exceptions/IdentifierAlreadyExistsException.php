<?php

namespace App\Exceptions;
class IdentifierAlreadyExistsException extends BaseApiException
{

    public function __construct()
    {
        parent::__construct('Invalid Identifier', 409);
    }
}
