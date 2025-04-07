<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case FINALIZED = 'finalized';
    case REFOUNDED = 'refounded';
    case CANCELED = 'canceled';

    public function getName(): string {
        return match ($this) 
        {
            self::PENDING => 'Pendente',
            self::FINALIZED => 'Finalizado',
            self::REFOUNDED => 'Rembolsado',
            self::CANCELED => 'Cancelado',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::PENDING => "bg-yellow-400",
            self::FINALIZED => "bg-green-400",
            self::REFOUNDED => "bg-orange-400",
            self::CANCELED => "bg-red-400",
            default => '',
        };
    }
}