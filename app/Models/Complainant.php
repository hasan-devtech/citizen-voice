<?php

namespace App\Models;

use App\Http\Resources\ComplainantResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Complainant extends Model
{
    use LogsActivity;
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;
    
    protected $fillable = [
        'identifier',
        'password',
        'birthdate',
        'is_verified',
        'full_name'
    ];

    protected static $recordEvents = ['updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'identifier',
                'birthdate',
                'full_name'
            ]);
    }

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'is_verified' => 'boolean',
            'password' => 'hashed',
            'birthdate' => 'date',
        ];
    }
    public function markAsVerified()
    {
        $this->update(['is_verified' => true]);
    }

    public function asResource()
    {
        return ComplainantResource::make($this);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function fcmTokens()
    {
        return $this->morphMany(FcmToken::class, 'user');
    }

    public function routeNotificationForFcm()
    {
        return $this->fcmTokens()->pluck('token')->toArray();
    }
    public function routeNotificationForMail()
    {
        return $this->identifier;
    }


}
