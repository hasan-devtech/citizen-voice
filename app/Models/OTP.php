<?php

namespace App\Models;

use App\Enums\OtpTypeEnum;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    protected $fillable = [
        'identifier',
        'type',
        'code',
        'expires_at',
        'is_used',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'code' => 'hashed',
            'type' => OtpTypeEnum::class,
        ];
    }
}
