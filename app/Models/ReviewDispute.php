<?php

namespace App\Models;

use App\Enums\DisputeResult;
use App\Enums\DisputeStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewDispute extends Model
{
    protected $fillable = [
        'review_id',
        'reason',
        'response',
        'result',
        'status',
    ];

    protected $casts = [
        'status' => DisputeStatus::class,
        'result' => DisputeResult::class
    ];

    public function review() : BelongsTo
    {
        return $this->belongsTo(Review::class);
    }
}
