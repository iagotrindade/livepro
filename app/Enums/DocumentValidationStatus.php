<?php

namespace App\Enums;

enum DocumentValidationStatus: string
{
    case ONAPPEL = 'on_appeal';
    case VALIDATED = 'validated';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case INVALIDATED = 'invalidated';

    public function getName(): string {
        return match ($this) 
        {
            self::ONAPPEL => 'Em recurso',
            self::VALIDATED => 'Validado',
            self::PENDING => 'Pendente',
            self::IN_PROGRESS => 'Em andamento',
            self::INVALIDATED => 'Invalidado',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::ONAPPEL => 'bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300',
            self::VALIDATED => 'bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500',
            self::PENDING => 'bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-purple-100 dark:bg-gray-700 dark:border-purple-500 dark:text-purple-400',
            self::IN_PROGRESS => 'bg--100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-yellow-100 dark:bg-gray-700 dark:border-yellow-500 dark:text-yellow-400',
            self::INVALIDATED => 'bg-red-100 text-red-600 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-red-100 dark:bg-gray-700 dark:border-red-300 dark:text-red-300',
            default => '',
        };
    }
}
