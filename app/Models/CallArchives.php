<?php

namespace App\Models;

use App\Enums\CallArchiveType;
use Illuminate\Database\Eloquent\Model;

class CallArchives extends Model
{
    protected $table = 'call_archives';

    protected function casts(): array
    {
        return [
            'type' => CallArchiveType::class
        ];
    }

    protected $fillable = [
        'room_id',
        'from_user_id',
        'to_user_id',
        'name',
        'type',
        'url',
        'created_at',
        'updated_at'
    ];
}
