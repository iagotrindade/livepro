<?php

namespace App\Enums;

enum DisputeResult :string
{
    case UNDER_ANALYSIS = 'under_analysis';
    case GRANTED = 'granted';
    case DISMISSED = 'dismissed';

    public function getName(): string {
        return match ($this) 
        {
            self::UNDER_ANALYSIS => 'Em análise',
            self::GRANTED => 'Deferido',
            self::DISMISSED => 'Indeferido',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::UNDER_ANALYSIS => 'bg-yellow-100 dark:bg-yellow-400 border-yellow-500',
            self::GRANTED => 'bg-green-100 dark:bg-green-400 border-green-500',
            self::DISMISSED => 'bg-red-100 dark:bg-red-400 border-red-500',
            default => '',
        };
    }
}
