<?php

namespace App\Http\Requests\Complainant;

use Illuminate\Foundation\Http\FormRequest;

class CreateComplaintRequest extends FormRequest
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
            'complaint_category_id' => 'required|exists:complaint_categories,id',
            'agency_id' => 'required|exists:agencies,id',
            'location_id' => 'required|exists:locations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx|max:10240', 
        ];
    }
}
