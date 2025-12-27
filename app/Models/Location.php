<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model
{
    use LogsActivity;
    use HasFactory, SoftDeletes;
    use Translatable;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $fillable = [
        'name_en',
        'name_ar',
        'name_ku',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name_en',
                'name_ar',
                'name_ku',
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
