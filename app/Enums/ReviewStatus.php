<?php

namespace App\Enums;

enum ReviewStatus :string
{
    case PUBLISHED = 'published';
    case HIDDEN = 'hidden';
    case UNDER_ANALYSIS = 'under_analysis';
    case DELETED = 'deleted';

    public function getName(): string {
        return match ($this) 
        {
            self::PUBLISHED => 'Publicado',
            self::HIDDEN => 'Ocultado',
            self::UNDER_ANALYSIS => 'Em análise',
            self::DELETED => 'Deletado',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::PUBLISHED => 'bg-green-100 dark:bg-green-400 border-green-500',
            self::HIDDEN => 'bg-gray-100 dark:bg-gray-700 border-gray-500',
            self::UNDER_ANALYSIS => 'bg-yellow-100 dark:bg-yellow-400 border-yellow-500',
            self::DELETED => 'bg-red-100 dark:bg-red-400 border-red-500',
            default => '',
        };
    }
}
