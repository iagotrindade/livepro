<?php

namespace App\Enums;

enum UserStatus :string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function getName(): string {
        return match ($this) 
        {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::ACTIVE => 'bg-green-400',
            self::INACTIVE => 'bg-red-400',
            default => '',
        };
    }
}
