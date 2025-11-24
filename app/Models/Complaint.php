<?php

namespace App\Models;

use App\Enums\ComplaintStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'complainant_id',
        'complaint_category_id',
        'agency_id',
        'location_id',
        'reference_number',
        'title',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => ComplaintStatusEnum::class,
    ];

    protected static function booted()
    {
        static::creating(function ($complaint) {
            if (!$complaint->reference_number) {
                $complaint->reference_number = 'CMP-' . Str::ulid();
            }
        });
    }


    public function complinant()
    {
        return $this->belongsTo(Complainant::class);
    }

    public function complaintCategory()
    {
        return $this->belongsTo(ComplaintCategory::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
