<?php

namespace App\Enums;

enum ScheduleStatus: string
{
    case INPROGRESS = 'in_progress';
    case FINISHED = 'finished';
    case SCHEDULED = 'scheduled';
    case CANCELED = 'canceled';
    case INDISPUTE = 'in_dispute';

    public function getName(): string
    {
        return match ($this) {
            self::INPROGRESS => 'Em andamento',
            self::FINISHED => 'Finalizado',
            self::SCHEDULED => 'Agendado',
            self::CANCELED => 'Cancelado',
            self::INDISPUTE => 'Em disputa',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string
    {
        return match ($this) {
            self::INPROGRESS => 'bg-yellow-400',
            self::FINISHED => 'bg-green-400',
            self::SCHEDULED => 'bg-orange-400',
            self::CANCELED => 'bg-red-400',
            self::INDISPUTE => 'bg-orange-400',
            default => '',
        };
    }
}
