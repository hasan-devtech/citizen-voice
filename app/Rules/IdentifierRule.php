<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class IdentifierRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isEmail = Validator::make(['id' => $value], ['id' => 'email:rfc,dns'])->passes();
        $isPhone = Validator::make(['id' => $value], ['id' => 'phone:SY'])->passes();
        if ($isEmail || $isPhone) {
            return;
        }
        $fail('The'. $attribute . 'must be a valid email or Syrian phone number');
    }
}
