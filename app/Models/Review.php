<?php

namespace App\Models;

use App\Enums\ReviewStatus;
use App\Models\ReviewDispute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'dispute_reason',
        'dispute_response',
        'status',
    ];

    protected $casts = [
        'status' => ReviewStatus::class,
    ];
    public function entity()
    {
        return $this->morphTo();
    }

    public function dispute() : HasOne
    {
        return $this->hasOne(ReviewDispute::class);
    }
}
