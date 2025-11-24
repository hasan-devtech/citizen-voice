<?php

namespace App\Enums;

enum OtpTypeEnum: string
{
    case REGISTER = 'register';
    case RESET_PASSWORD  = 'reset_password';

}
