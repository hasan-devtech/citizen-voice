<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->whenLoaded(
                'complaintCategory',
                fn() => new ComplaintCategoryResource($this->complaintCategory)
            ),
            'agency' => $this->whenLoaded(
                'agency',
                fn() => new AgencyResource($this->agency)
            ),
            'location' => $this->whenLoaded(
                'location',
                fn() => new LocationResource($this->location)
            ),
            'attachments' => $this->whenLoaded(
                'attachments',
                fn() => AttachmentResource::collection($this->attachments)
            ),
            'created_at' => $this->created_at->toDateTimeString(),
            'status' => $this->status,
        ];
    }
}
