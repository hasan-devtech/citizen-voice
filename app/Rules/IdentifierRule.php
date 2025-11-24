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
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return;
        }
        $phoneValidator = Validator::make(
            [$attribute => $value],
            [$attribute => 'phone:SY']
        );
        if ($phoneValidator->passes()) {
            return; 
        }
        $fail('The ' . $attribute . ' must be a valid email or phone number');
    }
}
