<?php

namespace App\Models;

use App\Enums\DocumentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'is_mandatory',
        'description',
    ];

    protected $casts = [
        'type' => DocumentType::class,
    ];

    public function professionalDocuments()
    {
        return $this->hasMany(ProfessionalDocument::class);
    }
}
