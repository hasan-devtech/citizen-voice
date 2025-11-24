<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class IdentifierService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function type($identifier)
    {
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }
        $isPhone = Validator::make(
            ['identifier' => $identifier],
            ['identifier' => 'phone:SY']
        )->passes();
        if ($isPhone) {
            return 'phone';
        }
        return 'unknown';
    }
}
