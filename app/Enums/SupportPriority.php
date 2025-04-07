<?php

namespace App\Enums;

enum SupportPriority :string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function getName(): string {
        return match ($this) 
        {
            self::LOW => 'Baixa',
            self::MEDIUM => 'Média',
            self::HIGH => 'Alta',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::LOW => 'text-green-400 dark:border-green-400',
            self::MEDIUM => 'text-yellow-400 dark:border-yellow-400',
            self::HIGH => 'text-red-400 dark:border-red-400',
            default => '',
        };
    }
}
