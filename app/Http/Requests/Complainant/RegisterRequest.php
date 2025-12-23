<?php

namespace App\Http\Requests\Complainant;

use App\Rules\IdentifierRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identifier' => ['required', 'string', new IdentifierRule()],
            'full_name' => ['required', 'string', 'max:127'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthdate' => ['required', 'date', 'before:' . now()->subYears(15)->format('Y-m-d')],
        ];
    }

    public function messages(): array
    {
        return [
            'birthdate.before' => 'You must be at least 15 years old',
        ];
    }
}
