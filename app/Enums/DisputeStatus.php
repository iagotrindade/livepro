<?php

namespace App\Enums;

enum DisputeStatus :string
{
    case OPEN = 'open';
    case CLOSED = 'closed';

    public function getName(): string {
        return match ($this) 
        {
            self::OPEN => 'Aberto',
            self::CLOSED => 'Fechado',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::OPEN => 'bg-yellow-100 dark:bg-yellow-400 border-yellow-500',
            self::CLOSED => 'bg-green-100 dark:bg-green-400 border-green-500',
            default => '',
        };
    }
}
