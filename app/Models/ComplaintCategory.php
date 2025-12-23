<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ComplaintCategory extends Model
{
    use LogsActivity;
    use HasFactory, SoftDeletes;
    use Translatable;
    protected $fillable = [
        'name_en',
        'name_ar',
        'name_ku',
        'description_en',
        'description_ar',
        'description_ku',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name_en',
                'name_ar',
                'name_ku',
                'description_en',
                'description_ar',
                'description_ku',
            ]);
    }
    public function scopeFilterName($query, $keyword)
    {
        return $query->when($keyword, function ($q, $keyword) {
            $q->where(function ($q) use ($keyword) {
                $q->where('name_en', 'like', "%{$keyword}%")
                    ->orWhere('name_ar', 'like', "%{$keyword}%")
                    ->orWhere('name_ku', 'like', "%{$keyword}%");
            });
        });
    }


    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
