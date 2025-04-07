<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProfessionalOccupation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'occupation_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id', 'id');
    }
}
