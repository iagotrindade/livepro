<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalDocument extends Model
{
    use HasFactory;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function document(): BelongsTo {
        return $this->belongsTo(Document::class);
    }

    public function documentValidation(): BelongsTo {
        return $this->belongsTo(DocumentValidation::class, 'id', 'professional_documents_id');
    }
}