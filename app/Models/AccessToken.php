<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $fillable = [
        'user_id', 
        'token',
        'used',
        'expires_at'
    ];
}
