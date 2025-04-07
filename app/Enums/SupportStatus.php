<?php

namespace App\Enums;

enum SupportStatus: string
{
    case INPROGRESS = 'in_progress';
    case OPEN = 'open';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';

    public function getName(): string {
        return match ($this) 
        {
            self::INPROGRESS => 'Em andamento',
            self::OPEN => 'Aberto',
            self::RESOLVED => 'Resolvido',
            self::CLOSED => 'Fechado',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::INPROGRESS => 'text-orange-400 dark:border-orange-400',
            self::OPEN => 'text-yellow-400 dark:border-yellow-400',
            self::RESOLVED => 'text-green-400 dark:border-green-400',
            self::CLOSED => 'text-red-400 dark:border-red-400',
            default => '',
        };
    }
}
