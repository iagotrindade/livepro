<?php

namespace App\Enums;

enum DisputeResult :string
{
    case OPEN = 'open';
    case UNDER_ANALYSIS = 'under_analysis';
    case IN_REVIEW = 'in_review';
    case GRANTED = 'granted';
    case DISMISSED = 'dismissed';

    public function getName(): string {
        return match ($this) 
        {
            self::OPEN => 'Aberto',
            self::UNDER_ANALYSIS => 'Em análise',
            self::IN_REVIEW => 'Em revisão',
            self::GRANTED => 'Deferido',
            self::DISMISSED => 'Indeferido',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::OPEN => 'bg-yellow-100 dark:bg-yellow-400 border-yellow-500',
            self::UNDER_ANALYSIS => 'bg-orange-100 dark:bg-orange-400 border-orange-500',
            self::IN_REVIEW => 'bg-orange-100 dark:bg-orange-400 border-orange-500',
            self::GRANTED => 'bg-green-100 dark:bg-green-400 border-green-500',
            self::DISMISSED => 'bg-red-100 dark:bg-red-400 border-red-500',
            default => '',
        };
    }
}
