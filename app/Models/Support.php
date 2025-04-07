<?php

namespace App\Models;

use App\Enums\SupportPriority;
use App\Enums\SupportStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Support extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => SupportStatus::class,
        'priority' => SupportPriority::class
    ];
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'entity');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function supportAgent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'support_agent_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(SupportCategory::class, 'support_categories_id', 'id', );
    }
}
