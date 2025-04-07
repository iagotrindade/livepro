<?php

namespace App\Enums;

enum RoomStatus: string
{
    case AVAILABLE = 'scheduled';
    case PENDING = 'paid';
    case REFUNDED = 'refunded';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';

    public function getName(): string {
        return match ($this) 
        {
            self::AVAILABLE => 'Agendado',
            self::PENDING => 'Pago',
            self::REFUNDED => 'Reembolsado',
            self::IN_PROGRESS => 'Em andamento',
            self::FINISHED => 'Finalizado',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::AVAILABLE => 'bg-green-100 dark:bg-green-400 border-green-500',
            self::PENDING => 'bg-blue-100 dark:bg-blue-400 border-blue-500',
            self::REFUNDED => 'bg-red-100 dark:bg-red-400 border-red-500',
            self::IN_PROGRESS => 'bg-purple-100 dark:bg-purple-400 border-purple-500',
            self::FINISHED => 'bg-gray-100 dark:bg-gray-700 border-gray-500',
            default => '',
        };
    }
}
