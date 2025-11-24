<?php

namespace App\Http\Resources;

use App\Traits\Translatable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintCategoryResource extends JsonResource
{
    use Translatable;

    public function toArray($request)
    {
        $lang = $request->attributes->get('lang');
        return [
            'id' => $this->id,
            'name' => $this->getTranslated($this, 'name', $lang),
            'description' => $this->getTranslated($this, 'description', $lang),
        ];
    }
}
