<?php

namespace App\Models;

use App\Enums\ScheduleStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'professional_id',
        'room_id',
        'payment_id',
        'protocol',
        'date',
        'start_time',
        'end_time',
        'duration',
        'status',
    ];

    protected $casts = [
        'status' => ScheduleStatus::class,
        'date' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
    public function professional(): BelongsTo
    {
        return $this->belongsTo(User::class, 'professional_id', 'id');
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    protected $appends = ['rating'];

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'entity');
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function dispute(): HasOne
    {
        return $this->hasOne(ServiceDispute::class);
    }
}
