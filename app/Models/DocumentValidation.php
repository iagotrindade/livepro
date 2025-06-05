<?php

namespace App\Models;

use App\Enums\DocumentValidationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'protocol',
        'professional_documents_id',
        'support_agent_id',
        'status',
        'justification',
    ];

    protected $casts = [
        'status' => DocumentValidationStatus::class,
    ];

    public function professionalDocument(): BelongsTo {
        return $this->belongsTo(ProfessionalDocument::class, 'professional_documents_id', 'id',);
    }

    public function supportAgent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'support_agent_id', 'id');
    }
}
