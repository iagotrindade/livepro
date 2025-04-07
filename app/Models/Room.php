<?php

namespace App\Models;

use App\Enums\RoomStatus;
use App\Models\CallArchives;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => RoomStatus::class,
        ];
    }

    public function recording(): BelongsTo {
        return $this->belongsTo(Recording::class);
    }

    public function archives(): HasMany {
        return $this->hasMany(CallArchives::class);
    }
}
