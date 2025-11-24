<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'disk',
        'mime_type',
        'size_kb',
        'is_public',
    ];

    public function attachable()
    {
        return $this->morphTo();
    }
}
