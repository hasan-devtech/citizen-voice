<?php

namespace App\Http\Requests\Complainant;

use App\Enums\ComplaintStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rules\Enum;

class GetComplaintsRequest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => ['nullable', new Enum(ComplaintStatusEnum::class)],
            'agency_id' => 'nullable|exists:agencies,id',
            'category_id' => 'nullable|exists:complaint_categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'per_page' => 'nullable|integer|min(1)|max(100)',
        ];
    }
}
