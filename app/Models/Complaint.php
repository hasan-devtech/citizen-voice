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

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'status' => ComplaintStatusEnum::class
        ];
    }

    protected static function booted()
    {
        static::creating(function ($complaint) {
            if (!$complaint->reference_number) {
                $complaint->reference_number = 'CMP-' . Str::ulid();
            }
        });
    }
    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['status'] ?? null, function ($q, $value) {
                $q->where('status', $value);
            })
            ->when($filters['agency_id'] ?? null, function ($q, $value) {
                $q->where('agency_id', $value);
            })
            ->when($filters['category_id'] ?? null, function ($q, $value) {
                $q->where('complaint_category_id', $value);
            })
            ->when($filters['location_id'] ?? null, function ($q, $value) {
                $q->where('location_id', $value);
            })
            ->when($filters['from'] ?? null, function ($q, $value) {
                $q->whereDate('created_at', '>=', $value);
            })
            ->when($filters['to'] ?? null, function ($q, $value) {
                $q->whereDate('created_at', '<=', $value);
            });
    }

    public function complainant()
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
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
