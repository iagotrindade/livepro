<?php

namespace App\Enums;

enum DocumentType: string
{
    case PERSONAL = 'personal';
    case PROFESSIONAL = 'professional';
    public function getName(): string {
        return match ($this) 
        {
            self::PERSONAL => 'Pessoal',
            self::PROFESSIONAL => 'Profissional',
            default => 'Desconhecido',
        };
    }
}
