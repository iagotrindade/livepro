<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Occupation extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function professionalOccupations()
    {
        return $this->hasMany(ProfessionalOccupation::class, 'occupation_id', 'id');
    }
}
